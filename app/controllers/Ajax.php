<?php

namespace Controller;


use Model\Bookmark;
use Model\Direct;
use Model\Follow;
use Model\Image;
use Model\Like;
use Model\Reply;
use Model\Request;
use Model\Retweet;
use Model\Session;
use Model\User;
use Model\Tweet;
use Model\Messages;
use Model\Lists;

defined('ROOTPATH') OR exit('Access Denied!');

class Ajax
{
    use MainController;

    public function index()
    {
        $ses = new Session();
        $req = new Request();
        $user = new User();
        $tweet = new Tweet();
        $messages = new Messages();
        $list = new Lists();
        $bookmark = new Bookmark();
        $direct = new Direct();
        $reply = new Reply();
        $like = new Like();
        $retweet = new Retweet();
        $follow = new Follow();

        if(!$ses->is_logged_in())
            die;

        $info['success'] = false;
        $post_data = $req->post();


        if($req->posted() && !empty($post_data['data_type']))
        {
            $info['data_type'] = $post_data['data_type'];

            if($post_data['data_type'] == 'new_tweet')
            {
                $files = $req->files();
                $folder = "uploads/";
                if(!file_exists($folder))
                {
                    mkdir($folder, 0777, true);
                }

                // validate file
                $file_added = false;

                foreach ($files as $key => $file)
                {
                    if($key == 'file')
                    {
                        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'video/mp4'];
                        $file_file = $file;

                        if(in_array($file['type'], $allowed))
                        {
                            $file_added = true;
                            $destination_file = $folder . time() . $file['name'];
                        } else {
                            $tweet->errors['file'] = 'This file type not supported';
                        }
                    }
                }

                if($tweet->validate($post_data))
                {


                    // move file if exists
                    if($file_added)
                    {
                        move_uploaded_file($file_file['tmp_name'], $destination_file);
                        $post_data['file'] = $destination_file;
                    }

                    $info['success'] = true;


                    $post_data['user_id'] = $ses->user('id');
                    $post_data['slug'] = $ses->user('slug');

                    // count tweets for users

                    $tweet->query('update users set tweets = tweets + 1 where id = :id', ['id'=>$post_data['user_id']]);

                    $tweet->insert($post_data);

                }

                $info['errors'] = $tweet->errors;

            } else
            if($post_data['data_type'] == 'delete_tweet')
            {
                $id = $req->input('id');
                $user_id = $ses->user('id');

                $row = $tweet->first(['id'=>$id]);

                if($row)
                {
                    // update count users tweets
                    $tweet->query('update users set tweets = tweets - 1 where id = :id', ['id'=>$user_id]);
                    // ------------------------- //

                    $tweet->delete($id);

                    $info['message'] = "Tweet deleted successfully";
                    $info['success'] = true;
                }
            } else
            if($post_data['data_type'] == 'new_reply' || $post_data['data_type'] == 'new_reply_for_reply')
            {
                $files = $req->files();
                $folder = "uploads/";
                if(!file_exists($folder))
                {
                    mkdir($folder, 0777, true);
                }

                // validate file
                $file_added = false;

                foreach ($files as $key => $file)
                {
                    if($key == 'file')
                    {
                        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'video/mp4'];
                        $file_file = $file;

                        if(in_array($file['type'], $allowed))
                        {
                            $file_added = true;
                            $destination_file = $folder . time() . $file['name'];
                        } else {
                            $reply->errors['file'] = 'This file type not supported';
                        }
                    }
                }

                if($reply->validate($post_data))
                {


                    // move file if exists
                    if($file_added)
                    {
                        move_uploaded_file($file_file['tmp_name'], $destination_file);
                        $post_data['file'] = $destination_file;
                    }

                    $info['success'] = true;

                    $post_data['replying_id'] = $req->input('replying_id');
                    $post_data['user_id'] = $ses->user('id');
                    $post_data['date'] = date('Y-m-d H:i:s');

                    // update reply counter
                    if($post_data['data_type'] == 'new_reply') {
                        $id = $req->input("tweet_id");
                        $tweet->query("update tweets set reply = reply + 1 where id =:tweet_id", ['tweet_id'=>$id]);
                    }
                    if($post_data['data_type'] == 'new_reply_for_reply') {
                        $id = $req->input("reply_id");
                        $reply->query("update reply set reply = reply + 1 where id =:reply_id", ['reply_id'=>$id]);
                    }

                    // update count users->replies

                    $reply->query('update users set replies = replies + 1 where id = :id', ['id'=>$post_data['user_id']]);

                    $reply->insert($post_data);

                }

                $info['errors'] = $reply->errors;

            } else
            if($post_data['data_type'] == 'new_messages')
            {
                $files = $req->files();
                $folder = "uploads/";
                if(!file_exists($folder))
                {
                    mkdir($folder, 0777, true);
                }

                // validate file
                $file_added = false;

                foreach ($files as $key => $file)
                {
                    if($key == 'file')
                    {
                        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'video/mp4'];
                        $file_file = $file;

                        if(in_array($file['type'], $allowed))
                        {
                            $file_added = true;
                            $destination_file = $folder . time() . $file['name'];
                        } else {
                            $messages->errors['file'] = 'This file type not supported';
                        }
                    }
                }

                if($messages->validate($post_data))
                {


                    // move file if exists
                    if($file_added)
                    {
                        move_uploaded_file($file_file['tmp_name'], $destination_file);
                        $post_data['file'] = $destination_file;
                    }

                    $user_id = \user('id');
                    $post_data['date'] = date('Y-m-d H:i:s');
                    $post_data['sender_id'] = $user_id;
                    $post_data['direct_id'] = $req->input('direct_id');
                    $post_data['recipient_id'] = $req->input('recipient_id');;
                    $info['success'] = true;


                    $messages->insert($post_data);

                }
                $info['errors'] = $messages->errors;

            } else
            if($post_data['data_type'] == 'delete_messages')
            {
                $id = $req->input('id');

                $row = $messages->first(['id'=>$id]);

                if($row)
                {
                    $messages->delete($id);

                    $info['message'] = "Bookmark changed successfully";
                    $info['success'] = true;
                }
            } else
            if ($post_data['data_type'] == 'follow')
            {

                $arr['follower_id'] = $req->input('follower_id');
                $arr['account_id'] = $req->input('account_id');

                // update count users->following

                $follow->query('update users set following = following + 1 where id = :id', ['id'=>$arr['follower_id']]);

                // update count users->follower

                $follow->query('update users set followers = followers + 1 where id = :id', ['id'=>$arr['account_id']]);


                $info['success'] = true;
                $follow->insert($arr);


            } else
            if ($post_data['data_type'] == 'unfollow')
            {

                $id = $req->input('id');
                $arr['follower_id'] = $req->input('follower_id');
                $arr['account_id'] = $req->input('account_id');

                $row = $follow->first(['id'=>$id]);

                if($row)
                {
                    // update count users->follower
                    $query = 'update users set following = following - 1 where id = :id';
                    $user->query($query, ['id'=>$arr['follower_id']]);

                    // update count users->following

                    $query = 'update users set followers = followers - 1 where id = :id';
                    $user->query($query, ['id'=>$arr['account_id']]);

                    $info['success'] = true;

                    $follow->delete($id);
                }

                $info['errors'] = $follow->errors;



            } else
            if ($post_data['data_type'] == 'new_lists')
            {
                $files = $req->files();
                $folder = "uploads/";
                if(!file_exists($folder))
                {
                    mkdir($folder, 0777, true);
                }

                // validate file
                $image_added = false;

                foreach ($files as $key => $file)
                {
                    if($key == 'image')
                    {
                        $allowed = ['image/jpeg', 'image/png', 'image/webp', 'video/mp4'];
                        $image_list = $file;

                        if(in_array($image_list['type'], $allowed))
                        {
                            $image_added = true;
                            $destination_image = $folder . time() . $image_list['name'];
                        } else {
                            $list->errors['image'] = 'This file type not supported';
                        }
                    }
                }

                if($list->validate($post_data))
                {

                    // move image if exists
                    if($image_added)
                    {
                        move_uploaded_file($image_list['tmp_name'], $destination_image);
                        $post_data['image'] = $destination_image;
                    }

                    $info['success'] = true;


                    $post_data['user_id'] = $ses->user('id');
                    $post_data['date'] = date('Y-m-d H:i:s');

                    $list->insert($post_data);

                }

                $info['errors'] = $list->errors;

            } else
            if($post_data['data_type'] == 'pinned_lists')
            {
                $user_id = \user('id');
                $list_id = $req->input('list_id');
                $row = $list->first(['id'=>$list_id, 'user_id'=>$user_id]);


                if($row)
                {
                    $role = 'pinned';
                    $list->update($list_id, ['role' => $role]);
                    $info['message'] = "Role changed successfully";
                    $info['success'] = true;
                }

            } else
            if($post_data['data_type'] == 'new_direct')
            {

                $second_user = $req->input('second_user');

                $row = $user->first(['id'=>$second_user]);

                if($row)
                {
                    $first_user = \user('id');
                    $arr = [];
                    $arr['first_user'] = $first_user;
                    $arr['second_user'] = $second_user;

                    $direct->insert($arr);

                    $info['message'] = "Direct creat successfully";
                    $info['success'] = true;
                }
            } else
            if($post_data['data_type'] == 'save_tweet' || $post_data['data_type'] == 'save_reply')
            {
                $arr['user_id'] = $req->input('user_id');

                if($post_data['data_type'] == 'save_tweet')
                {
                    $arr['tweet_id'] = $req->input('tweet_id');
                    // update bookmark

                    $query = "update tweets set bookmark = bookmark + 1 where id =:tweet_id limit 1";
                    $tweet->query($query, ['tweet_id'=>$arr['tweet_id']]);
                }



                if($post_data['data_type'] == 'save_reply')
                {
                    $arr['reply_id'] = $req->input('reply_id');
                    // update bookmark

                    $query = "update reply set bookmark = bookmark + 1 where id =:reply_id limit 1";
                    $reply->query($query, ['reply_id'=>$arr['reply_id']]);
                }




                $bookmark->insert($arr);

                $info['message'] = "Bookmark changed successfully";
                $info['success'] = true;


            } else
            if ($post_data['data_type'] == 'delete_save' || $post_data['data_type'] == 'delete_reply_save')
            {

                $id = $req->input('bookmark_id');

                $row = $bookmark->first(['id'=>$id]);

                if($row)
                {

                    $bookmark->delete($id);

                    if($post_data['data_type'] == 'delete_save'){
                        // update bookmark
                        $tweet_id = $req->input('tweet_id');

                        $query = "update tweets set bookmark = bookmark - 1 where id =:tweet_id limit 1";
                        $tweet->query($query, ['tweet_id'=>$tweet_id]);
                    }

                    if($post_data['data_type'] == 'delete_reply_save') {
                        // update bookmark
                        $reply_id = $req->input('reply_id');

                        $query = "update reply set bookmark = bookmark - 1 where id =:reply_id limit 1";
                        $reply->query($query, ['reply_id'=>$reply_id]);
                    }

                    $info['message'] = "Bookmark changed successfully";
                    $info['success'] = true;
                }

            } else
            if($post_data['data_type'] == 'new_retweet' || $post_data['data_type'] == 'new_retweet_reply') {

                $arr['user_id'] = \user('id');


                if ($post_data['data_type'] == 'new_retweet') {
                    $arr['tweet_id'] = $req->input('tweet_id');
                    // update retweet

                    $query = "update tweets set retweet = retweet + 1 where id =:tweet_id limit 1";
                    $tweet->query($query, ['tweet_id' => $arr['tweet_id']]);
                }

                if ($post_data['data_type'] == 'new_retweet_reply') {
                    $arr['reply_id'] = $req->input('reply_id');

                    // update retweet

                    $query = "update reply set retweet = retweet + 1 where id =:reply_id limit 1";
                    $reply->query($query, ['reply_id' => $arr['reply_id']]);
                }


                $retweet->insert($arr);


                $info['success'] = true;
            }  else
            if($post_data['data_type'] == 'delete_retweet' || $post_data['data_type'] == 'delete_retweet_reply')
            {
                $arr['user_id'] = $req->input('user_id');

                $id = $req->input('id');

                $row = $retweet->first(['id'=>$id]);


                if($row)
                {

                    $retweet->delete($id);

                    $info['message'] = "Retweet changed successfully";
                    $info['success'] = true;
                    // update retweet
                    if($post_data['data_type'] == 'delete_retweet'){

                        $tweet_id = $req->input('tweet_id');

                        $query = "update tweets set retweet = retweet - 1 where id =:tweet_id limit 1";
                        $tweet->query($query, ['tweet_id'=>$tweet_id]);
                    }
                    // update retweet
                    if($post_data['data_type'] == 'delete_retweet_reply') {

                        $reply_id = $req->input('reply_id');

                        $query = "update reply set retweet = retweet - 1 where id =:reply_id limit 1";
                        $reply->query($query, ['reply_id'=>$reply_id]);
                    }

                }
            } else
            if($post_data['data_type'] == 'get_like' || $post_data['data_type'] == 'get_like_reply')
            {

                $arr['user_id'] = \user('id');


                if($post_data['data_type'] == 'get_like') {
                    $arr['tweet_id'] = $req->input('tweet_id');
                    // update likes

                    $query = "update tweets set likeable = likeable + 1 where id =:tweet_id limit 1";
                    $tweet->query($query, ['tweet_id'=>$arr['tweet_id']]);
                }

                if($post_data['data_type'] == 'get_like_reply') {
                    $arr['reply_id'] = $req->input('reply_id');

                    // update likes

                    $query = "update reply set likeable = likeable + 1 where id =:reply_id limit 1";
                    $reply->query($query, ['reply_id'=>$arr['reply_id']]);
                }


                $like->insert($arr);


                $info['success'] = true;

            } else
            if($post_data['data_type'] == 'delete_like' || $post_data['data_type'] == 'delete_like_reply')
            {
                $arr['user_id'] = $req->input('user_id');


                $id = $req->input('id');

                $row = $like->first(['id'=>$id]);


                if($row)
                {

                    $like->delete($id);

                    $info['message'] = "Bookmark changed successfully";
                    $info['success'] = true;
                    if($post_data['data_type'] == 'delete_like'){
                        // update likes
                        $tweet_id = $req->input('tweet_id');

                        $query = "update tweets set likeable = likeable - 1 where id =:tweet_id limit 1";
                        $tweet->query($query, ['tweet_id'=>$tweet_id]);
                    }

                    if($post_data['data_type'] == 'delete_like_reply') {
                        // update likes
                        $reply_id = $req->input('reply_id');

                        $query = "update reply set likeable = likeable - 1 where id =:reply_id limit 1";
                        $reply->query($query, ['reply_id'=>$reply_id]);
                    }

                }
            } else
            if ($post_data['data_type'] == 'unpinned_lists')
            {
                $user_id = \user('id');
                $list_id = $req->input('list_id');
                $row = $list->first(['id'=>$list_id, 'user_id'=>$user_id]);


                if($row)
                {
                    $role = 'unpinned';
                    $list->update($list_id, ['role' => $role]);
                    $info['message'] = "Role changed successfully";
                    $info['success'] = true;
                }

            } else
            if($post_data['data_type'] == 'profile-settings')
            {

                $user_id = user('id');

                $user = new User();

                $row = $user->first(['id'=>$user_id]);


                if($row)
                {
                    $files = $req->files();

                    $folder = 'uploads/';
                    if(!file_exists($folder))
                    {
                        mkdir($folder, 0777, true);
                        file_put_contents($folder.'index.php', 'Access Denied');
                    }

                    // validate image
                    $header_added = false;
                    $avatar_added = false;

                    foreach ($files as $key => $file)
                    {
                        if($key == 'header' )
                        {
                            $allowed = ['image/jpeg', 'image/png', 'image/webp'];
                            $header_image = $file;

                            if (in_array($file['type'], $allowed)) {
                                $header_added = true;
                                $destination_header = $folder . time() . $file['name'];


                            } else {
                                $user->errors['header'] = "Header image type not supported";
                            }
                        }else
                            if($key == 'avatar' )
                            {
                                $allowed = ['image/jpeg', 'image/png', 'image/webp'];
                                $avatar_image = $file;

                                if (in_array($file['type'], $allowed)) {
                                    $avatar_added = true;
                                    $destination_avatar = $folder . time() . $file['name'];

                                } else {
                                    $user->errors['avatar'] = "Avatar image type not supported";
                                }
                            }
                    }
                    if($user->validate($req->post(),$user_id))
                    {

                        // move header file if exists
                        if($header_added)
                        {
                            move_uploaded_file($header_image['tmp_name'], $destination_header);
                            $post_data['header'] = $destination_header;

                            $image = new Image();
                            $image->resize($destination_header, 800);

                            if(file_exists($row->header))
                                unlink($row->header);

                        }

                        // move avatar file if exists
                        if($avatar_added)
                        {
                            move_uploaded_file($avatar_image['tmp_name'], $destination_avatar);
                            $post_data['avatar'] = $destination_avatar;

                            // delete old avatar files
                            if(file_exists($row->avatar))
                                unlink($row->avatar);

                        }



                        $post_data['username'] = $req->input('username');
                        $post_data['bio'] = $req->input('bio');
                        $post_data['location'] = $req->input('location');
                        $post_data['website'] = $req->input('website');

                        $user->update($user_id, $post_data);

                        $info['message'] = 'Profile edited';
                        $info['success'] = true;
                    }else{
                        $info['message'] = "ERROR: " . implode(" & ", $user->errors);
                        $info['success'] = false;
                    }
                }
            }

        }
        echo json_encode($info);
    }
}
