<?php

namespace Controller;


use Model\Follow;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;


defined('ROOTPATH') OR exit ('Access Denied');
// Notifications class

class Notifications
{
    use MainController;


    public function index()
    {
        $data['section'] = 'all';

        $tweet = new myTweet();
        $ses = new Session();
        $user = new User();
        $follow = new Follow();
        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

        $query = "select t.*,u.username, u.slug as user_slug from tweets as t join users as u on u.id =t.user_id limit 10";
        $data['rows'] = $tweet->query($query);

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $this->view('notifications', $data);
    }

    public function all()
    {
        $data['section'] = 'all';
        $ses = new Session();
        $user = new User();
        $follow = new Follow();
        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $this->view('notifications', $data);
    }

    public function verified()
    {
        $data['section'] = 'verified';
        $ses = new Session();
        $user = new User();
        $follow = new Follow();

        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $this->view('notifications', $data);
    }

    public function mentions()
    {
        $data['section'] = 'mentions';
        $ses = new Session();
        $user = new User();
        $follow = new Follow();
        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $this->view('notifications', $data);
    }
}
