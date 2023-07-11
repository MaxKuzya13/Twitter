<?php

namespace Controller;


use Model\Request;
use Model\User;

defined('ROOTPATH') OR exit ('Access Denied');
// Signup class

class Signup
{
    use MainController;

    public function index()
    {

        $this->view('signup');
    }
}
