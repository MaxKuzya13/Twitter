<?php

namespace Controller;


use Controller\MainController;
use Model\Follow;
use Model\Request;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Messages class

class Lists
{
    use MainController;


    public function index()
    {
        $data['section'] = 'default';

        $ses = new Session();
        $list = new \Model\Lists();
        $user = new User();
        $follow = new Follow();
        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);


        // Відображення трендів //
        $data['trends'] = $user->findAll();

        // Show follow //

        $data['follows'] = $follow->query('select * from follow where follower_id = :follower_id limit 10', ['follower_id'=>$user_id]);

        // ------------------------------------------------------- //

        if(!$ses->is_logged_in())
            redirect('home');


        $query = "select l.*,u.username, u.email, u.avatar from lists as l join users as u on u.id =l.user_id where u.id = :user_id limit 10";
        $data['rows'] = $list->query($query, ['user_id'=>$user_id]);
        $role = 'pinned';
        $data['pinned'] = $list->where(['user_id'=>$user_id, 'role'=>$role]);

        $this->view('lists', $data);
    }

    public function create()
    {
        $data['section'] = 'create';

        $ses = new Session();
        $list = new \Model\Lists();
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

        $query = "select l.*,u.username, u.email, u.avatar from lists as l join users as u on u.id =l.user_id where u.id = :user_id limit 10";
        $data['rows'] = $list->query($query, ['user_id'=>$user_id]);
        $role = 'pinned';
        $data['pinned'] = $list->where(['user_id'=>$user_id, 'role'=>$role]);

        $this->view('lists', $data);
    }



}
