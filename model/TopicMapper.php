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

}