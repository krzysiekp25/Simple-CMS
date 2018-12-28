<?php
require_once __DIR__.'/../model/CommentMapper.php';
class ArticleController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function article()
    {
        $mapper = new ArticleMapper();
        $article = $mapper->getArticleById($_GET['id']);

        $topicMapper = new TopicMapper();
        $topicList = $topicMapper->getAllTopics();

        $commentMapper = new CommentMapper();
        $commentsExists = $commentMapper->commentsExists($_GET['id']);
        $this->render('article', ['topicList' => $topicList, 'article' => $article, 'commentsExists' => $commentsExists]);
    }

    public function addArticle()
    {
        if (isset($_SESSION) && !empty($_SESSION)) {
            if ($this->isPost()) {

                $mapper = new ArticleMapper();
                ob_start();
                var_dump($_POST);
                error_log(ob_get_clean());
                $newArticleId = $mapper->createNewArticle($_POST['title_name'], $_POST['content'], $_SESSION['id'], $_POST['id_topic']);
                $url = "http://$_SERVER[HTTP_HOST]/";
                header("Location: {$url}?page=article&id=" . $newArticleId);
                exit();
            } else {
                $mapper = new TopicMapper();
                $topicList = $mapper->getAllTopics();
                $this->render('add_article', ['topicList' => $topicList]);
            }
        } else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=home");
            exit();
        }
    }

    public function addTopic()
    {
        if (isset($_SESSION) && !empty($_SESSION) && $_SESSION['role'] == 'admin') {
            if ($this->isPost()) {
                $mapper = new TopicMapper();
                ob_start();
                var_dump($_POST);
                error_log(ob_get_clean());
                if ($_POST['topicName'] != null && !$mapper->topicExist($_POST['topicName'])) {
                    if ($mapper->addTopic($_POST['topicName']) != 0) {
                        $this->render('add_topic_success', ['message' => ['Dodawanie tematu zakończone pomyślnie!']]);
                        exit();
                    } else {
                        $this->render('add_topic', ['topicErrorMessage' => 'Wystąpił problem z dodawaniem tematu do bazy danych.']);
                    }

                } else {
                    $this->render('add_topic', ['topicErrorMessage' => 'Taki temat już istnieje.']);
                    exit();
                }

            }
            $this->render('add_topic');
        } else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=home");
            exit();
        }
    }

    public function topic()
    {
        $mapper = new ArticleMapper();
        $articleList = $mapper->getArticlesByTopicId($_GET['id']);

        $topicMapper = new TopicMapper();
        $topicList = $topicMapper->getAllTopics();
        $topicName = null;
        /* @var $topic Topic */
        foreach ($topicList as $topic) {
            if ($topic->getIdTopic() == $_GET['id']) {
                $topicName = $topic->getTopic();
                break;
            }
        }
        $this->render('topic', ['articleList' => $articleList, 'topicName' => $topicName, 'topicList' => $topicList]);
    }

}