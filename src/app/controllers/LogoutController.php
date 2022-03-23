<?php
use Phalcon\Mvc\Controller;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Http\Request;
use App\Forms\RegisterForm;
use App\Forms\LoginForm;
use Phalcon\Http\Response;
class LogoutController extends Controller
{
    public function indexAction()
    {
        $this->session->destroy();
        header("location:/login");
    }
}