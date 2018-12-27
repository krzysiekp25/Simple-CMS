<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 24.12.2018
 * Time: 22:07
 */

class TopicMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getAllTopics() :array{
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM topic t');
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $topicList = [];
            foreach ($result as $rawArticle) {
                array_push($topicList, new Topic($rawArticle['id_topic'], $rawArticle['topic']));
            }
            /*ob_start();
            var_dump($topicList);
            error_log(ob_get_clean());*/
            return $topicList;
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function topicExist(string $topicName) :bool {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM topic where topic = :topicName');
        $stmt->bindParam(":topicName", $topicName, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$result) {
            return false;
        }
        return true;
    }

    public function addTopic(string $topicName) :bool {
        $connection = $this->database->connect();
        $stmt = $connection->prepare(
            'INSERT INTO topic (topic) VALUES (:topicName)');
        $stmt->bindParam(':topicName', $topicName, PDO::PARAM_STR);
        $stmt->execute();
        return $connection->lastInsertId();
    }

}