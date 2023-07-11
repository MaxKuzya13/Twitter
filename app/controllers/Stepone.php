<?php

namespace Controller;


use Model\Pager;
use Model\Request;
use Model\Session;
use Model\User;


defined('ROOTPATH') OR exit ('Access Denied');
// Signup class

class Stepone
{
    use MainController;

    public function index()
    {
        $data['section'] = 'stepone';

        $data['user'] = new User();
        $req = new Request();
        if($req->posted())
        {
            $data['user']->signup($_POST);
        }

        $this->view('stepone', $data);
    }

    public function steptwo($slug = null)
    {
        $data['section'] = 'steptwo';

        $this->view('stepone', $data);
    }

    public function stepthree()
    {
        $data['section'] = 'stepthree';


        $this->view('stepone', $data);
    }

    public function stepfour()
    {
        $data['section'] = 'stepfour';


        $this->view('stepone', $data);
    }

    public function stepfive()
    {
        $data['section'] = 'stepfive';


        $this->view('stepone', $data);
    }

}