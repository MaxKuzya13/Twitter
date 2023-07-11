<?php

namespace Controller;


use Controller\MainController;
use Model\Direct;
use Model\Request;
use Model\Session;
use Model\Tweet as myTweet;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Messages class

class Messages
{
    use MainController;


    public function index()
    {
        $data['section'] = 'default';
        $data['directs'] = '';
        $arr = [];
        $ses = new Session();
        $user = new User();

        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

        $user = new User();


        $arr['find'] = $_GET['find'] ?? null;

        // Відображення того що знайде в пошуковому полі //
        if($arr['find'])
        {
            $arr['find'] = $arr['find'] . "%";
            $data['rows']= $rows = $user->query("select * from users where username like :find", $arr);
        }
        // ------------------------------------------------------ //
//
//        Це якщо створили ми діалог
        $query = "select d.id as direct_id, u.* from users as u join direct as d on u.id = d.second_user where d.first_user = :user_id limit 10";
        $row_one = $user->query($query, ['user_id'=>$user_id]);


// ????????????????????????????????????????????????????????????????????????????????????????????????
//        Це якщо створив хтось інший діалог і написав нам
        $query = "select d.id as direct_id, u.* from users as u join direct as d on u.id = d.first_user where d.second_user = :user_id limit 10";
        $row_two = $user->query($query, ['user_id'=>$user_id]);


//        ///////////////////////////////////////////////////////////////////////////////////////////////
// Об'єднали масиви аби показувалось і те і інше, відсортували по зниженню direct_id //
        if(!empty($row_one) || !empty($row_two))
        {
            if(!empty($row_one) && !empty($row_two)) {
                $data['directs'] = array_merge($row_one, $row_two);
            } else
            if(!empty($row_one) && empty($row_two)) {
                $data['directs'] = $row_one;
            } else
            if(empty($row_one) && !empty($row_two)) {
                $data['directs'] = $row_two;
            }
            arsort($data['directs']);

        }
//        ///////////////////////////////////////////////////////////////////////////////////////////////
        $this->view('messages', $data);
    }

    public function compose()
    {
        $data['section'] = 'compose';
        $ses = new Session();
        $user = new User();
        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');


        $data['rows'] = "";
        $arr = [];

        // Відображення SEARCH //
        $arr['find'] = $_GET['find'] ?? null;

        if($arr['find'])
        {
            $arr['find'] = $arr['find'] . '%';
            $data['rows'] = $user->query('select * from users where username like :find', $arr);
        }
        // ------------------------------------------------------ //

//        Це якщо створили ми діалог
        $query = "select d.id as direct_id, u.* from users as u join direct as d on u.id = d.second_user where d.first_user = :user_id limit 10";
        $row_one = $user->query($query, ['user_id'=>$user_id]);


// ????????????????????????????????????????????????????????????????????????????????????????????????
//        Це якщо створив хтось інший діалог і написав нам
        $query = "select d.id as direct_id, u.* from users as u join direct as d on u.id = d.first_user where d.second_user = :user_id limit 10";
        $row_two = $user->query($query, ['user_id'=>$user_id]);


//        ///////////////////////////////////////////////////////////////////////////////////////////////
// Об'єднали масиви аби показувалось і те і інше, відсортували по зниженню direct_id //
        if(!empty($row_one) || !empty($row_two))
        {
            if(!empty($row_one) && !empty($row_two)) {
                $data['directs'] = array_merge($row_one, $row_two);
            } else
                if(!empty($row_one) && empty($row_two)) {
                    $data['directs'] = $row_one;
                } else
                    if(empty($row_one) && !empty($row_two)) {
                        $data['directs'] = $row_two;
                    }
            arsort($data['directs']);

        }
//        ///////////////////////////////////////////////////////////////////////////////////////////////


        $this->view('messages', $data);
    }


    public function private($id = null)
    {
        $data['section'] = 'direct';

        $data['sender'] = [];
        $data['recipient'] = [];
        $data['privates'] = [];
        $ses = new Session();


        $user = new User();
        $user_id = \user('id');
        $data['user'] = $user->first(['id'=>$user_id]);

        if(!$ses->is_logged_in())
            redirect('home');

//        Це якщо створили ми діалог
        $query = "select d.id as direct_id, u.* from users as u join direct as d on u.id = d.second_user where d.first_user = :user_id limit 10";
        $row_one = $user->query($query, ['user_id'=>$user_id]);

// ????????????????????????????????????????????????????????????????????????????????????????????????
//        Це якщо створив хтось інший діалог і написав нам
        $query = "select d.id as direct_id, u.* from users as u join direct as d on u.id = d.first_user where d.second_user = :user_id limit 10";
        $row_two = $user->query($query, ['user_id'=>$user_id]);

//        ///////////////////////////////////////////////////////////////////////////////////////////////
// Об'єднали масиви аби показувалось і те і інше, відсортували по зниженню direct_id //
        if(!empty($row_one) || !empty($row_two))
        {
            if(!empty($row_one) && !empty($row_two)) {
                $data['directs'] = array_merge($row_one, $row_two);
            } else
                if(!empty($row_one) && empty($row_two)) {
                    $data['directs'] = $row_one;
                } else
                    if(empty($row_one) && !empty($row_two)) {
                        $data['directs'] = $row_two;
                    }
            arsort($data['directs']);
        }



        // ПОказ чела з ким переписуємось, якщо самі йому пишемо
        $query = "select d.id as direct_id, d.*, u.* from users as u join direct as d on u.id = d.second_user where d.id = :id limit 10";
        $sender = $user->query($query, ['id'=>$id]);
//        ________________________________________________________________________________________________________________________________

        // ПОказ чела з ким переписуємось, якщо він нам написав

        $query = "select d.id as direct_id, d.*, u.* from users as u join direct as d on u.id = d.first_user where d.id = :id limit 10";
        $recipient = $user->query($query, ['id'=>$id]);


        // Об'днуємо масиви
        if(!empty($sender) || !empty($recipient)) {
            if(!empty($sender) && !empty($recipient)) {
                $data['privates'] = array_merge($sender, $recipient);
            } else
            if(!empty($sender) && empty($recipient)) {
                $data['privates'] = $sender;
            }  else
            if(empty($sender) && !empty($recipient)) {
                $data['privates'] = $recipient;
            }

        }


//        ___________________________________________________________________________________
        // Відправлені смс
        $query = "select m.* from messages as m join direct as d on d.id = m.direct_id where d.id = :id && m.sender_id = :user_id order by m.id limit 10";
        $sends = $user->query($query, ['id'=>$id, 'user_id'=>$user_id]);

        // Прийняті смс
        $query = "select m.* from messages as m join direct as d on d.id = m.direct_id where d.id = :id && m.recipient_id = :user_id order by m.id limit 10";
        $received = $user->query($query, ['id'=>$id, 'user_id'=>$user_id]);

//        Всі смс
        if(!empty($sends) || !empty($received))
        {
            if(!empty($sends) && !empty($received)) {
                $data['messages'] = array_merge($sends, $received);
            } else
                if(!empty($sends) && empty($received)) {
                    $data['messages'] = $sends;
                }  else
                    if(empty($sends) && !empty($received)) {
                        $data['messages'] = $received;
                    }
            sort($data['messages']);
        }

//        ___________________________________________________________________________________

        $this->view('messages', $data);
    }

}
