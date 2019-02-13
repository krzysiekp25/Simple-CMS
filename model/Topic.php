<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 24.12.2018
 * Time: 11:50
 */

class Topic
{
    private $id_topic;
    private $topic;

    public function __construct($id_topic, $topic)
    {
        $this->id_topic = $id_topic;
        $this->topic = $topic;
    }

    public function getIdTopic()
    {
        return $this->id_topic;
    }

    public function setIdTopic($id_topic): void
    {
        $this->id_topic = $id_topic;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function setTopic($topic): void
    {
        $this->topic = $topic;
    }


}