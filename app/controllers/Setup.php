<?php

namespace Controller;

use Controller\MainController;
use Model\Follow;
use Model\Request;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Setup class

class Setup
{
    use MainController;


    public function index()
    {
        $data = [];

        $ses = new Session();
        $user = new User();
        $follow = new Follow();
        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

        $data['row'] = $user->first(['id'=>$user_id]);

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //


        $this->view('setup', $data);
    }

}
