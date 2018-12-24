<?php

class Article
{
    private $id_article;
    private $title;
    private $content;

    private $owner;
    private $topic;

    public function __construct($id_article, $title, $content, $owner, $topic)
    {
        $this->id_article = $id_article;
        $this->title = $title;
        $this->content = $content;
        $this->owner = $owner;
        $this->topic = $topic;
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }

    public function setIdArticle($id_article): void
    {
        $this->id_article = $id_article;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content): void
    {
        $this->content = $content;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwner($owner): void
    {
        $this->owner = $owner;
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