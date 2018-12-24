<?php

require_once "AppController.php";
require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';
require_once __DIR__.'/../model/Article.php';
require_once __DIR__.'/../model/ArticleMapper.php';
require_once __DIR__.'/../model/TopicMapper.php';


class DefaultController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $articleMapper = new ArticleMapper();
        $topicMapper = new TopicMapper();

        $text = 'Hello there 👋';
        $articleList = $articleMapper->getAllArticles();
        $topicList = $topicMapper->getAllTopics();

        $this->render('home', ['text' => $text, 'articleList' => $articleList, 'topicList' => $topicList]);
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

        $this->render('home', ['text' => 'You have been successfully logged out!']);
    }
}