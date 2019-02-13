<?php
require_once __DIR__ . '/../model/CommentMapper.php';

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

    public function deleteArticle()
    {

        if ($this->isPost()) {
            if (isset($_SESSION) && !empty($_SESSION)) {
                $mapper = new ArticleMapper();
                ob_start();
                var_dump($mapper->getArticleOwnerId($_POST['articleId']));
                error_log(ob_get_clean());
                ob_start();
                var_dump($_SESSION['id']);
                error_log(ob_get_clean());
                if ($_SESSION['id'] == $mapper->getArticleOwnerId($_POST['articleId']) || $_SESSION['role'] == 'admin') {
                    $mapper->deleteArticleById($_POST['articleId']);
                    $message = 'Artykuł usunięty.';
                    $status = array(
                        'error' => 0,
                        'message' => $message
                    );
                    echo json_encode($status);
                    exit();
                }
            }
        }
        $message = 'Błąd: Brak uprawnień do usunięcia.';
        $status = array(
            'error' => 1,
            'message' => $message
        );
        echo json_encode($status);
        exit();

    }

    public function deleteTopic()
    {
        if ($this->isPost()) {
            if (isset($_SESSION) && !empty($_SESSION)) {
                if ($_SESSION['role'] == 'admin') {
                    $articleMapper = new ArticleMapper();
                    if ($articleMapper->deleteTopicById($_POST['topicId'])) {
                        $message = 'Artykuł usunięty.';
                        $status = array(
                            'error' => 0,
                            'message' => $message
                        );
                    } else {
                        $message = 'Wystąpił problem przy usuwaniu.';
                        $status = array(
                            'error' => 1,
                            'message' => $message
                        );
                    }
                    echo json_encode($status);
                    exit();
                }
            }
            $message = 'Błąd: Brak uprawnień do usunięcia.';
            $status = array(
                'error' => 1,
                'message' => $message
            );
            echo json_encode($status);
            exit();
        }
    }

    public function modifyArticle()
    {
        if (isset($_SESSION) && !empty($_SESSION)) {
            ob_start();
            var_dump($_GET);
            error_log(ob_get_clean());
            $articleMapper = new ArticleMapper();
            if ($_SESSION['id'] == $articleMapper->getArticleOwnerId($_GET['id']) || $_SESSION['role'] == 'admin') {
                if ($this->isPost()) {
                    ob_start();
                    var_dump($_POST);
                    error_log(ob_get_clean());
                    $articleMapper->modifyArticle($_POST['title_name'], $_POST['content'], $_POST['id_topic'], $_GET['id']);
                    $url = "http://$_SERVER[HTTP_HOST]/";
                    header("Location: {$url}?page=article&id=" . $_GET['id']);
                    exit();
                } else {
                    ob_start();
                    var_dump($_GET);
                    error_log(ob_get_clean());
                    $article = $articleMapper->getArticleById($_GET['id']);
                    $topicMapper = new TopicMapper();
                    $topicList = $topicMapper->getAllTopics();
                    $this->render('modify_article', ['topicList' => $topicList, 'article' => $article]);
                    exit();
                }
            }
        }
        ob_start();
        var_dump($_GET);
        error_log(ob_get_clean());
        $url = "http://$_SERVER[HTTP_HOST]/";
        header("Location: {$url}?page=article&id=" . $_GET['id']);
        exit();
    }
}