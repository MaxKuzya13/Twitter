<?php

namespace Controller;


use Controller\MainController;
use Model\Bookmark;
use Model\Follow;
use Model\Reply;
use Model\Request;
use Model\Retweet;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Status class

class Status
{
    use MainController;


    public function index($id)
    {
        $data['section'] = 'default';


        $tweet = new \Model\Tweet();
        $bookmark = new Bookmark();
        $ses = new Session();
        $user = new User();
        $retweet = new Retweet();
        $follow = new Follow();
        $user_id = \user('id');


        if(!$ses->is_logged_in())
            redirect('home');

        // Твіта і коментів до нього //

        $query = "select t.*,u.username, u.avatar, u.slug as user_slug from tweets as t join users as u on u.id =t.user_id where t.id = :id";
        $data['tweet'] = $tweet->query($query, ['id'=>$id]);
        $data['tweet'] = $data['tweet'][0];


        $query = "select r.*, u.username, u.avatar from reply as r join users as u on r.user_id =u.id where r.tweet_id =:tweet_id";
        $data['replyes'] = $tweet->query($query, ['tweet_id'=>$id]);

        // -----------------------------------------------------------//

        // update views and popularity

        $query = "update tweets set views = views + 1 where id = :id limit 1";
        $tweet->query($query, ['id' => $id]);

        $views = $data['tweet']->views + 1;
        $popularity = floor($views / 2);
        $tweet->query('update tweets set popularity = :popularity where id = :id limit 1', ['popularity'=>$popularity, 'id'=>$id]);

        // ------------------------------------------------------------ //

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        // Відображення лайків , ретвітів і букмарків//

        $query = "select l.* from likes as l join tweets as t on l.tweet_id =t.id where l.user_id = :user_id";
        $data['likesTweets'] = $tweet->query($query, ['user_id'=>$user_id]);

        $query = "select l.* from likes as l join reply as r on l.reply_id =r.id where l.user_id = :user_id";
        $data['likesReply'] = $tweet->query($query, ['user_id'=>$user_id]);

        $query = "select r.*, t.id as id_tweet from retweet as r join tweets as t on r.tweet_id = t.id where r.user_id = :user_id";
        $data['retweetTweet'] = $retweet->query($query, ['user_id'=>$user_id]);

        $query = "select ret.*, rep.id as id_reply from retweet as ret join reply as rep on ret.reply_id = rep.id where ret.user_id = :user_id";
        $data['retweetReply'] = $retweet->query($query, ['user_id'=>$user_id]);

        $query = "select b.*, t.id as id_tweet from bookmark as b join tweets as t on b.tweet_id = t.id where b.user_id = :user_id";
        $data['tweetBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select b.*, r.id as id_reply from bookmark as b join reply as r on b.reply_id = r.id where b.user_id = :user_id";
        $data['replyBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        // ------------------------------------------------------------ //

        $data['user'] = $user->first(['id'=>$user_id]);


        $this->view('status', $data);
    }

    public function reply($id)
    {
        $data['section'] = 'reply';

        $user = new User();
        $reply = new Reply();
        $bookmark = new Bookmark();
        $ses = new Session();
        $retweet = new Retweet();
        $follow = new Follow();

        if(!$ses->is_logged_in())
            redirect('home');

        $user_id = \user('id');

        // Відображення реплая і твіта до якого зроблено комент і всіх інших коментів//

        $query = "select r.*,u.username, u.avatar from reply as r join users as u on u.id =r.user_id where r.id = :reply_id";
        $lines = $reply->query($query, ['reply_id'=>$id]);
        $data['row'] = $lines[0];
        $data['reply'] = $data['row'];

        $query = "select t.*, u.username, u.avatar from tweets as t join reply as r on t.id = r.tweet_id join users as u on t.user_id = u.id where r.id = :reply_id";
        $data['tweet'] = $reply->query($query, ['reply_id'=>$id]);
        $data['tweet'] = $data['tweet'][0];

        $query = "select r.*, u.username, u.avatar from reply as r join users as u on r.user_id =u.id where r.reply_id =:reply_id";
        $data['replyes'] = $reply->query($query, ['reply_id'=>$id]);
        // ------------------------------------------------------------ //

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        // update views and popularity

        $query = "update reply set views = views + 1 where id = :id limit 1";
        $reply->query($query, ['id' => $id]);

        $views = $data['reply']->views + 1;


        // ------------------------------------------------------------ //


        // Відображення лайків і букмарків- //

        $query = "select l.* from likes as l join reply as r on l.reply_id =r.id where l.user_id = :user_id";
        $data['likesReply'] = $reply->query($query, ['user_id'=>$user_id]);

        $query = "select l.* from likes as l join tweets as t on l.tweet_id = t.id where l.user_id = :user_id";
        $data['likesTweet'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select r.*, t.id as id_tweet from retweet as r join tweets as t on r.tweet_id = t.id where r.user_id = :user_id";
        $data['retweetTweet'] = $retweet->query($query, ['user_id'=>$user_id]);

        $query = "select ret.*, rep.id as id_reply from retweet as ret join reply as rep on ret.reply_id = rep.id where ret.user_id = :user_id";
        $data['retweetReply'] = $retweet->query($query, ['user_id'=>$user_id]);

        $query = "select b.*, t.id as id_tweet from bookmark as b join tweets as t on b.tweet_id = t.id where b.user_id = :user_id";
        $data['tweetBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        $query = "select b.*, r.id as id_reply from bookmark as b join reply as r on b.reply_id = r.id where b.user_id = :user_id";
        $data['replyBookmark'] = $bookmark->query($query, ['user_id'=>$user_id]);

        // ------------------------------------------------------------ //

        $data['user'] = $user->first(['id'=>$user_id]);


        $this->view('status', $data);
    }


}
