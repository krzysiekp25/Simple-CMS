<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 25.12.2018
 * Time: 18:50
 */
require_once "AppController.php";

class LoginController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $mapper = new UserMapper();

        $user = null;

        if ($this->isPost()) {

            $user = $mapper->getUser($_POST['email']);
           /* var_dump($user);*/
            if(empty($user->getIdUser())) {
                return $this->render('login', ['message' => ['Email not recognized']]);
            }

            if ($user->getPassword() !== $_POST['password']) {
                return $this->render('login', ['message' => ['Wrong password']]);
            } else {
                $_SESSION["id"] = $user->getEmail();
                $_SESSION['name'] = $user->getUserDetails()->getName();
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


        $this->render('logout', ['message' => ['Pomyślnie wylogowano!']]);
    }

    public function register()
    {
        $mapper = new UserMapper();
        if($this->isPost()) {
            $emailErrorMessage = null;
            $loginErrorMessage = null;
            $passwordErrorMessage = null;

            if($mapper->emailExist($_POST['email']))
            {
                $emailErrorMessage = 'Podany email jest już zajęty';
            }
            if($mapper->loginExist($_POST['login'])) {
                $loginErrorMessage = 'Podany login jest już zajęty';
            }
            if($_POST['password'] != $_POST['password-confirmation']) {
                $passwordErrorMessage = 'Podane hasła nie są identyczne';
            }
            if($emailErrorMessage != null || $loginErrorMessage != null || $passwordErrorMessage != null) {
                $this->render('register', ['emailErrorMessage' => $emailErrorMessage, 'loginErrorMessage' => $loginErrorMessage, 'passwordErrorMessage' => $passwordErrorMessage]);
                exit();
            }
            //todo szyfrowanie hasla i wywolanie stworzenia usera a po tym obsluge logowania z odszyfrowywaniem
        }
        $this->render('register');
    }
}