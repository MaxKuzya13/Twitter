<?php

namespace Controller;


use Controller\MainController;
use Model\Bookmark;
use Model\Follow;
use Model\Request;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Messages class

class Bookmarks
{
    use MainController;


    public function index()
    {
        $data['section'] = 'default';
        $user = new User();
        $bookmark = new Bookmark();
        $ses = new Session();
        $tweet = new myTweet();
        $follow = new Follow();
        $user_id = \user('id');


        if(!$ses->is_logged_in())
            redirect('home');

        $data['user'] = $user->first(['id'=>$user_id]);

        // Відображення збережених твітів та коментів //
        $query = "select b.id as bookmark_id, t.*,u.username, u.avatar from tweets as t join users as u on u.id =t.user_id join bookmark as b on b.tweet_id =t.id where b.user_id = :user_id order by b.id desc limit 10";
        $tweetSave = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select b.id as bookmark_id, r.*,u.username, u.avatar from reply as r join users as u on u.id =r.user_id join bookmark as b on b.reply_id =r.id where b.user_id = :user_id order by b.id desc limit 10";
        $replySave = $bookmark->query($query, ['user_id'=>$user_id]);
        // ---------------------------------------------------------- //

        // Об'єднання масивів //
        if(!empty($tweetSave) || !empty($replySave))
        {
            if(!empty($tweetSave) && !empty($replySave)) {
                $data['rows'] = array_merge($tweetSave, $replySave);
            } else
                if(!empty($tweetSave) && empty($replySave)) {
                    $data['rows'] = $tweetSave;
                } else
                    if(empty($tweetSave) && !empty($replySave)) {
                        $data['rows'] = $replySave;
                    }

            arsort($data['rows']);
        } else {
            $data['rows'] = "";
        }
        // ---------------------------------------------------------- //

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);


        // Кнопка букмарк для твіта і комента //
        $query = "select b.*, t.id as id_tweet from bookmark as b join tweets as t on b.tweet_id = t.id where b.user_id = :user_id";
        $data['tweetBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select b.*, r.id as id_reply from bookmark as b join reply as r on b.reply_id = r.id where b.user_id = :user_id";
        $data['replyBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        // ---------------------------------------------------------- //

        // Відображення лайків  //
        $query = "select l.*, t.id as id_tweet from likes as l join tweets as t on l.tweet_id = t.id where l.user_id = :user_id";
        $data['likesTweet'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select l.* from likes as l join reply as r on l.reply_id =r.id where l.user_id = :user_id";
        $data['likesReply'] = $tweet->query($query, ['user_id'=>$user_id]);

        // ---------------------------------------------------------- //

        $this->view('bookmarks', $data);
    }



}
