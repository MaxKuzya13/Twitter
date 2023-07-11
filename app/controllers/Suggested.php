<?php

namespace Controller;

use Controller\MainController;
use Model\Follow;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Homefull class

class Suggested
{
    use MainController;


    public function index()
    {
        $tweet = new myTweet();
        $ses = new Session();
        $user = new User();
        $user_id = \user('id');
        $follow = new Follow();
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

        $query = "select t.*,u.username from tweets as t join users as u on u.id =t.user_id limit 10";
        $data['rows'] = $tweet->query($query);

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $this->view('suggested', $data);
    }
}
