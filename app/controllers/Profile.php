<?php

namespace Controller;

use Model\Bookmark;
use Model\Follow;
use Model\Like;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Profile class

class Profile
{
    use MainController;


    public function index($id)
    {
        $data['section'] = 'tweets';
        $user = new User();
        $tweet = new myTweet();
        $bookmark = new Bookmark();
        $user_id = \user('id');
        $ses = new Session();
        $follow = new Follow();

        if(!$ses->is_logged_in())
            redirect('home');

        $query = "select t.*,u.username, u.avatar from tweets as t join users as u on u.id =t.user_id where u.id = :user_id limit 10";
        $data['rows'] = $tweet->query($query, ['user_id'=>$id]);

        $data['follow'] = $follow->first(['follower_id'=>$user_id, 'account_id'=>$id]);

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $query = "select l.*, t.id as id_tweet from likes as l join tweets as t on l.tweet_id = t.id where l.user_id = :user_id";
        $data['likesTweet'] = $tweet->query($query, ['user_id'=>$user_id]);

        $query = "select b.*, t.id as id_tweet from bookmark as b join tweets as t on b.tweet_id = t.id where b.user_id = :user_id";
        $data['tweetBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $data['user'] = $user->first(['id'=>$user_id]);
        $data['profile'] = $user->first(['id'=>$id]);

        $this->view('profile', $data);
    }

    public function replies($id)
    {
        $data['section'] = 'replies';
        $user = new User();
        $tweet = new myTweet();
        $ses = new Session();
        $follow = new Follow();

        if(!$ses->is_logged_in())
            redirect('home');

        $user_id = \user('id');

        $query = "select t.*,u.username, u.avatar, u.slug as user_slug from tweets as t join users as u on u.id =t.user_id where u.id = :user_id limit 10";
        $data['rows'] = $tweet->query($query, ['user_id'=>$id]);

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $data['user'] = $user->first(['id'=>$user_id]);
        $data['profile'] = $user->first(['id'=>$id]);

        $this->view('profile', $data);
    }

    public function media($id)
    {
        $data['section'] = 'media';
        $user = new User();
        $ses = new Session();
        $follow = new Follow();

        if(!$ses->is_logged_in())
            redirect('home');

        $user_id = \user('id');

        $data['user'] = $user->first(['id'=>$user_id]);
        $data['profile'] = $user->first(['id'=>$id]);

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $this->view('profile', $data);
    }

    public function likes($id)
    {
        $data['section'] = 'likes';
        $user = new User();
        $ses = new Session();
        $tweet = new myTweet();
        $follow = new Follow();

        if(!$ses->is_logged_in())
            redirect('home');

        $user_id = \user('id');

        $data['user'] = $user->first(['id'=>$user_id]);
        $data['profile'] = $user->first(['id'=>$id]);

        $query = "select l.id as likes_id, t.*,u.username, u.avatar from tweets as t join users as u on u.id =t.user_id join likes as l on l.tweet_id =t.id where l.user_id = :user_id limit 10";
        $data['rowsLikes'] = $tweet->query($query, ['user_id'=>$id]);

        $query = "select l.*, t.id as id_tweet from likes as l join tweets as t on l.tweet_id = t.id where l.user_id = :user_id";
        $data['likesTweet'] = $tweet->query($query, ['user_id'=>$user_id]);

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

//        $query = "select b.id as bookmark_id, t.*,u.username, u.avatar from tweets as t join users as u on u.id =t.user_id join bookmark as b on b.tweet_id =t.id where b.user_id = :user_id order by b.id desc limit 10";
//        $tweetSave = $bookmark->query($query, ['user_id'=>$user_id]);


        $this->view('profile', $data);
    }
}
