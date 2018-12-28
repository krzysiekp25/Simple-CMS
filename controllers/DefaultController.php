<?php

require_once "AppController.php";
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/UserMapper.php';
require_once __DIR__ . '/../model/Article.php';
require_once __DIR__ . '/../model/ArticleMapper.php';
require_once __DIR__ . '/../model/TopicMapper.php';


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
}