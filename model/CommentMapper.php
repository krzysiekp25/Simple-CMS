<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 28.12.2018
 * Time: 17:51
 */
require_once __DIR__ . '/../Database.php';
require_once __DIR__ . '/Comment.php';

class CommentMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function addComment(int $id_article, string $comment, int $id_user)
    {
        try {
            $connection = $this->database->connect();
            $stmt = $connection->prepare('INSERT INTO comment (id_article, comment, id_user) VALUES (:id_article, :comment, :id_user)');
            $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }

    }

    public function getCommentsByArticleId(int $id_article): array
    {
        try {
            $connection = $this->database->connect();
            $stmt = $connection->prepare('SELECT * FROM comment c inner join user u on c.id_user = u.id_user where c.id_article = :id_article order by c.auditcd desc');
            $stmt->bindParam(':id_article', $id_article, PDO::PARAM_INT);
            $stmt->execute();
            $rawCommentList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $commentList = [];
            foreach ($rawCommentList as $comment) {
                array_push($commentList, new Comment($comment['id_comment'], $comment['id_article'], $comment['comment'], $comment['id_user'], $comment['auditcd'], $comment['login']));
            }
            return $commentList;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }

    }

    public function commentsExists(int $id)
    {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM comment where id_article = :id_article');
        $stmt->bindParam(":id_article", $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function getCommentOwnerId(int $id)
    {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT id_user FROM comment where id_comment = :id_comment');
            $stmt->bindParam(":id_comment", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['id_user'];
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function deleteComment(int $id)
    {
        $stmt = $this->database->connect()->prepare(
            'DELETE FROM comment where id_comment = :id_comment');
        $stmt->bindParam(":id_comment", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}