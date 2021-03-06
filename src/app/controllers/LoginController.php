<?php

use Phalcon\Mvc\Controller;
use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;
use Phalcon\Http\Request;
use App\Forms\RegisterForm;
use App\Forms\LoginForm;
use Phalcon\Http\Response;
use Phalcon\Http\Response\Cookies;

class LoginController extends Controller
{
    public function indexAction()
    {
        $users = new Users();
        if ($this->cookies->has("cookie")) {
            header('location: /dashboard');
        } else {
            if ($this->request->isPost()) {
                // return $this->response->redirect('user/login');
                // $this->view->message = "post";
                $response = new Response();
                $request = new Request();
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                if (empty($email) || empty($password)) {
                    // $this->view->message = $email;
                    $response->setStatusCode(403, 'Error');
                    $response->setContent("Authentication Failed");
                    $response->send();
                } else {
                    $user = Users::findFirst(array(
                        'email = :email: and password = :password:', 'bind' => array(
                            'email' => $this->request->getPost("email"),
                            'password' => $this->request->getPost("password")
                        )
                    ));
                    if (!$user) {
                        $response->setStatusCode(404, 'Wrong Credentials');
                        $response->setContent("Incorrect Credentials");
                        $response->send();
                    } else {

                        global $container;
                        // $cookies  = new Cookies();
                        $cookies = $container->get('cookies');
                        $this->session->set('id', $user->user_id);
                        $this->session->set('email', $user->email);
                        if (isset($_POST['remember_me'])) {
                            $cookies->set(
                                "cookie",
                                json_encode([
                                    "email" => $email,
                                    "password" => $password
                                ]),
                                time() + 3600
                            );
                        }
                        header('location: /dashboard');
                    }
                }
            }
        }
    }
}
