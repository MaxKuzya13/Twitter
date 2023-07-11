<?php

namespace Controller;


use Model\Follow;
use Model\Request;
use Model\Session;
use Model\User;
use Model\Tweet as myTweet;

defined('ROOTPATH') OR exit ('Access Denied');
// Homefull class

class Tweet
{
    use MainController;

    public function index($action = null, $slug = null)
    {
        $data = [];
        $user = new User();
        $follow = new Follow();

        $user_id = \user('id');

        $data['user'] = $user->first(['id'=>$user_id]);

        $data['action'] = $action;
        $data['slug'] = $slug;

        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        $this->view('tweet', $data);

    }
}
