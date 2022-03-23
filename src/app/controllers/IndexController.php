<?php

use Phalcon\Mvc\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {
        $this->view->users = Users::find();
        // return '<h1>Hello World!</h1>';
    }
    public function logoutAction()
    {
        echo "logout";
        // return '<h1>Hello World!</h1>';
    }

}