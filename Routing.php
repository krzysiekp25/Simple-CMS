<?php

require_once('controllers/DefaultController.php');
require_once('controllers/UploadController.php');
require_once('controllers/PlayerController.php');
require_once('controllers/ArticleController.php');

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
                'controller' => 'DefaultController',
                'action' => 'login'
            ],
            'logout' => [
                'controller' => 'DefaultController',
                'action' => 'logout'
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