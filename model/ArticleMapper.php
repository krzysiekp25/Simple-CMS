<?php

require_once 'Article.php';
require_once 'Topic.php';
require_once __DIR__ . '/../Database.php';

class ArticleMapper
{

    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllArticles(): array
    {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM article a inner join topic t on a.id_topic = t.id_topic inner join user u on a.owner = u.id_user');
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $article = [];
            foreach ($result as $rawArticle) {
                $user = new User($rawArticle['id_user'], null, $rawArticle['email'], $rawArticle['login'], null);
                $topic = new Topic($rawArticle['id_topic'], $rawArticle['topic']);
                array_push($article, new Article($rawArticle['id_article'], $rawArticle['title'], $rawArticle['content'], $user, $topic, $rawArticle['auditcd'], $rawArticle['auditmd']));
            }
            /*ob_start();
            var_dump($article);
            error_log(ob_get_clean());*/
            return $article;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getArticlesByTopicId(int $id_topic): array
    {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM article a inner join topic t on a.id_topic = t.id_topic inner join user u on a.owner = u.id_user where t.id_topic = :id_topic');
            $stmt->bindParam(':id_topic', $id_topic, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $article = [];
            foreach ($result as $rawArticle) {
                $user = new User($rawArticle['id_user'], null, $rawArticle['email'], $rawArticle['login'], null);
                $topic = new Topic($rawArticle['id_topic'], $rawArticle['topic']);
                array_push($article, new Article($rawArticle['id_article'], $rawArticle['title'], $rawArticle['content'], $user, $topic, $rawArticle['auditcd'], $rawArticle['auditmd']));
            }
            return $article;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function createNewArticle(string $title, string $content, int $owner, int $id_topic): int
    {
        try {
            $connection = $this->database->connect();

            $stmt = $connection->prepare(
                'INSERT INTO article (title, content, owner, id_topic) VALUES (:title, :content, :owner, :id_topic)');
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            $stmt->bindParam(':owner', $owner, PDO::PARAM_INT);
            $stmt->bindParam(':id_topic', $id_topic, PDO::PARAM_INT);
            $stmt->execute();
            return $connection->lastInsertId();
        } catch (PDOException $e) {
            return 'Error ' . $e->getMessage();
        }
    }

    public function getArticleById(int $id_article)
    {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM article a inner join topic t on a.id_topic = t.id_topic inner join user u on a.owner = u.id_user where a.id_article = :id_article');
            $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            ob_start();
            var_dump($result);
            error_log(ob_get_clean());
            $user = new User($result['id_user'], null, $result['email'], $result['login'], null);
            $topic = new Topic($result['id_topic'], $result['topic']);
            return new Article($result['id_article'], $result['title'], $result['content'], $user, $topic, $result['auditcd'], $result['auditmd']);
            /*ob_start();
            var_dump($article);
            error_log(ob_get_clean());*/
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteArticleById(int $id_article) {
        try {
            $connection = $this->database->connect();
            $connection->beginTransaction();
            $stmt1 = $connection->prepare(
                'DELETE FROM comment WHERE id_article = :id_article');
            $stmt1->bindParam(':id_article', $id_article, PDO::PARAM_INT);
            $stmt1->execute();

            $stmt2 = $connection->prepare(
                'DELETE FROM article WHERE id_article = :id_article');
            $stmt2->bindParam(':id_article', $id_article, PDO::PARAM_INT);
            $stmt2->execute();
            return $connection->commit();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getArticleOwnerId(int $id_article) {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT owner FROM article where id_article = :id_article');
            $stmt->bindParam(":id_article", $id_article, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['owner'];
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteTopicById($topicId)
    {
        try {
            $connection = $this->database->connect();
            $connection->beginTransaction();
            // GETTING TOPIC ARTICLE LIST
            $stmt1 = $connection->prepare(
                'SELECT * FROM article a inner join topic t on a.id_topic = t.id_topic inner join user u on a.owner = u.id_user where t.id_topic = :id_topic');
            $stmt1->bindParam(':id_topic', $topicId, PDO::PARAM_INT);
            $stmt1->execute();

            $result = $stmt1->fetchAll(PDO::FETCH_ASSOC);

            $articleList = [];
            foreach ($result as $rawArticle) {
                $user = new User($rawArticle['id_user'], null, $rawArticle['email'], $rawArticle['login'], null);
                $topic = new Topic($rawArticle['id_topic'], $rawArticle['topic']);
                array_push($articleList, new Article($rawArticle['id_article'], $rawArticle['title'], $rawArticle['content'], $user, $topic, $rawArticle['auditcd'], $rawArticle['auditmd']));
            }

            //DELETING ARTICLE LIST
            /* @var $article Article*/
            foreach ($articleList as $article) {
                $articleId = $article->getIdArticle();
                $stmt2 = $connection->prepare(
                    'DELETE FROM comment WHERE id_article = :id_article');
                $stmt2->bindParam(':id_article', $articleId, PDO::PARAM_INT);
                $stmt2->execute();

                $stmt3 = $connection->prepare(
                    'DELETE FROM article WHERE id_article = :id_article');
                $stmt3->bindParam(':id_article', $articleId, PDO::PARAM_INT);
                $stmt3->execute();
            }

            //DELETING TOPIC
            $stmt4 = $connection->prepare(
                'DELETE FROM topic WHERE id_topic = :id_topic');
            $stmt4->bindParam(':id_topic', $topicId, PDO::PARAM_INT);
            $stmt4->execute();

            return $connection->commit();

        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }


    }
}