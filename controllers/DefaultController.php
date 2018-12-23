<?php

require_once "AppController.php";
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';


class DefaultController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $text = 'Hello there 👋';

        $this->render('home', ['text' => $text]);
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);
            var_dump($user);
            if(!$user) {
                return $this->render('login', ['message' => ['Email not recognized']]);
            }

            if ($user->getPassword() !== $_POST['password']) {
                return $this->render('login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["id"] = $user->getEmail();
                $_SESSION["role"] = $user->getRole()->getRole();

                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=home");
                exit();
            }
        }

        if(isset($_SESSION) && !empty($_SESSION)) {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=home");
            exit();
        }
        $this->render('login');
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        $this->render('home', ['text' => 'You have been successfully logged out!']);
    }
}