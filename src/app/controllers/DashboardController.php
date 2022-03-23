<?php

use Phalcon\Mvc\Controller;


class DashboardController extends Controller
{
    public function indexAction()
    {
        global $container;
        $datetime = $container->get('datetime');
        $this->view->datetime = $datetime;
        $email = $this->session->get("email");
        if(!$email)
        {
            header('location:http://localhost:8080/login');
        }
    }
}
