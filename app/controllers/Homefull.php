<?php

namespace Controller;


use Model\Bookmark;
use Model\Follow;
use Model\Request;
use Model\Retweet;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Homefull class

class Homefull
{
    use MainController;


    public function index()
    {
        $data['section'] = 'default';

        $ses = new Session();
        if(!$ses->is_logged_in())
            redirect('home');

        $user = new User();
        $tweet = new myTweet();
        $bookmark = new Bookmark();
        $retweet = new Retweet();
        $follow = new Follow();


        $user_id = \user('id');

        // Відображення твітів //
        $query = "select t.*,u.username, u.avatar, u.slug as user_slug from tweets as t join users as u on u.id =t.user_id order by t.id desc ";
        $data['rows'] = $tweet->query($query);
        $data['user'] = $user->first(['id'=>$user_id]);

        // -------------------------------- //

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);


        // -----------------------------------//

        // -------------------------------- //

        // Відображення лайків, ретвітів, букмарків //
        $query = "select b.*, t.id as id_tweet from bookmark as b join tweets as t on b.tweet_id = t.id where b.user_id = :user_id";
        $data['tweetBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select r.*, t.id as id_tweet from retweet as r join tweets as t on r.tweet_id = t.id where r.user_id = :user_id";
        $data['retweetTweet'] = $retweet->query($query, ['user_id'=>$user_id]);

        $query = "select l.*, t.id as id_tweet from likes as l join tweets as t on l.tweet_id = t.id where l.user_id = :user_id";
        $data['likesTweet'] = $tweet->query($query, ['user_id'=>$user_id]);

        // -------------------------------- //

        $this->view('homefull', $data);
    }

    public function foryou()
    {
        $data['section'] = 'default';

        $ses = new Session();
        if(!$ses->is_logged_in())
            redirect('home');

        $user = new User();
        $tweet = new myTweet();
        $bookmark = new Bookmark();


        $user_id = \user('id');




        // Відображення твітів //
        $query = "select t.*,u.username, u.avatar, u.slug as user_slug from tweets as t join users as u on u.id =t.user_id order by t.id desc";
        $data['rows'] = $tweet->query($query);
        $data['user'] = $user->first(['id'=>$user_id]);

        // -------------------------------- //

        // Відображення лайків і букмарків //
        $query = "select b.*, t.id as id_tweet from bookmark as b join tweets as t on b.tweet_id = t.id where b.user_id = :user_id";
        $data['tweetBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select l.*, t.id as id_tweet from likes as l join tweets as t on l.tweet_id = t.id where l.user_id = :user_id";
        $data['likesTweet'] = $tweet->query($query, ['user_id'=>$user_id]);

        // -------------------------------- //

        $this->view('homefull', $data);
    }

    public function following()
    {
        $data['section'] = 'default';

        $ses = new Session();
        if(!$ses->is_logged_in())
            redirect('home');

        $user = new User();
        $tweet = new myTweet();
        $bookmark = new Bookmark();


        $user_id = \user('id');

        // Відображення твітів //
        $query = "select t.*,u.username, u.avatar, u.slug as user_slug from tweets as t join users as u on u.id =t.user_id order by t.id desc";
        $data['rows'] = $tweet->query($query);
        $data['user'] = $user->first(['id'=>$user_id]);

        // -------------------------------- //

        // Відображення лайків і букмарків //
        $query = "select b.*, t.id as id_tweet from bookmark as b join tweets as t on b.tweet_id = t.id where b.user_id = :user_id";
        $data['tweetBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select l.*, t.id as id_tweet from likes as l join tweets as t on l.tweet_id = t.id where l.user_id = :user_id";
        $data['likesTweet'] = $tweet->query($query, ['user_id'=>$user_id]);

        // -------------------------------- //

        $this->view('homefull', $data);
    }

    public function compose($id)
    {
        $data['section'] = 'compose';

        $ses = new Session();
        $user = new User();
        $tweet = new myTweet();

        if(!$ses->is_logged_in())
            redirect('home');

        $user_id = \user('id');

        // Відображення твітів на фоні //

        $query = "select t.*,u.username, u.avatar from tweets as t join users as u on u.id =t.user_id order by t.id desc";
        $data['rows'] = $tweet->query($query);
        $data['user'] = $user->first(['id'=>$user_id]);

        // -------------------------------- //

        // Відображення Compose //
        $query = "select t.*,u.username, u.avatar, u.id as user_id from tweets as t join users as u on u.id =t.user_id where t.id = :id";
        $lines = $tweet->query($query, ['id'=>$id]);
        $data['line'] = $lines[0];
        // -------------------------------- //

        $query = "select l.* from likes as l join tweets as t on l.tweet_id =t.id where l.user_id = :user_id";
        $data['likesTweet'] = $tweet->query($query, ['user_id'=>$user_id]);


        $this->view('homefull', $data);
    }

    public function compose_reply($id)
    {
        $data['section'] = 'compose_reply';

        $ses = new Session();
        $user = new User();
        $tweet = new myTweet();

        if(!$ses->is_logged_in())
            redirect('home');

        $user_id = \user('id');

        // Відображення твітів на фоні //
        $query = "select t.*,u.username, u.avatar from tweets as t join users as u on u.id =t.user_id order by t.id desc ";
        $data['rows'] = $tweet->query($query);
        $data['user'] = $user->first(['id'=>$user_id]);
        // ------------------------------------------------------ //

        // Відображення Compose reply //
        $query = "select r.*,u.username, u.avatar, u.id as user_id from reply as r join users as u on u.id =r.user_id where r.id = :id ";
        $lines = $tweet->query($query, ['id'=>$id]);
        $data['line'] = $lines[0];
        // ------------------------------------------------------ //

        // Інфа про твіт, до якого був написаний комент //
        $query = "select t.*,u.username, u.avatar, u.id as user_id from tweets as t join reply as r on r.tweet_id = t.id join users as u on t.user_id = u.id where r.id = :id";
        $line = $tweet->query($query, ['id'=>$id]);
        $data['tweet'] = $line[0];
        // ------------------------------------------------------ //

        $query = "select u.username from tweets as t join reply as r on r.tweet_id = t.id join users as u on t.user_id = u.id where r.id = :id limit 1";
        $recipient = $tweet->query($query, ['id'=>$id]);
        $data['recipient'] = $recipient[0];

//        $query = "select u.username from users as u join reply as r on r.replying_id = u.id where r.id = $id limit 1";
//        $recipientReply = $tweet->query($query);
//        $data['recipientReply'] = $recipientReply[0];


        $query = "select l.* from likes as l join tweets as t on l.tweet_id =t.id where l.user_id = :user_id";
        $data['likesTweet'] = $tweet->query($query, ['user_id'=>$user_id]);



        $this->view('homefull', $data);
    }
}
