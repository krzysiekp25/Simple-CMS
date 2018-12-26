<?php

require_once('controllers/DefaultController.php');
require_once('controllers/UploadController.php');
require_once('controllers/PlayerController.php');
require_once('controllers/ArticleController.php');
require_once('controllers/TestController.php');
require_once('controllers/LoginController.php');

class Routing
{
    public $routes = [];

    public function __construct()
    {
        $this->routes = [
            'home' => [
                'controller' => 'DefaultController',
                'action' => 'home'
            ],
            'login' => [
                'controller' => 'LoginController',
                'action' => 'login'
            ],
            'logout' => [
                'controller' => 'LoginController',
                'action' => 'logout'
            ],
            'register' => [
              'controller' => 'LoginController',
              'action' => 'register'
            ],
            'upload' => [
                'controller' => 'UploadController',
                'action' => 'upload'
            ],
            'player' => [
                'controller' => 'PlayerController',
                'action' => 'player'
            ],
            'article' => [
                'controller' => 'ArticleController',
                'action' => 'article'
            ],
            'test_session_mapper' => [
                'controller' => 'TestController',
                'action' => 'test_session_mapper'
            ],
            'test_session_insert' => [
                'controller' => 'TestController',
                'action' => 'test_session_insert'
            ]
        ];
    }

    public function run()
    {
        $page = isset($_GET['page'])
            && isset($this->routes[$_GET['page']]) ? $_GET['page'] : 'home';

        if ($this->routes[$page]) {
            $class = $this->routes[$page]['controller'];
            $action = $this->routes[$page]['action'];

            $object = new $class;
            $object->$action();
        }
    }

}