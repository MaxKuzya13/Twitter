<?php

namespace Controller;


use Model\User;
use Model\Tweet;


defined('ROOTPATH') OR exit ('Access Denied');
// Home class

class Home
{
    use MainController;

    public function index()
    {
        $user = new User();
        $tweet = new Tweet();

        $user_id = \user('id');

        $query = "select t.*,u.username, u.avatar, u.slug as user_slug from tweets as t join users as u on u.id =t.user_id order by t.id desc limit 10";
        $data['rows'] = $tweet->query($query);
        $data['user'] = $user->first(['id'=>$user_id]);



        $this->view('home', $data);
    }
}
