<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 28.12.2018
 * Time: 17:48
 */

class Comment
{
    private $id_comment;
    private $id_article;
    private $comment;
    private $id_user;
    private $userLogin;
    private $auditcd;

    public function __construct($id_comment, $id_article, $comment, $id_user, $auditcd, $userLogin)
    {
        $this->id_comment = $id_comment;
        $this->id_article = $id_article;
        $this->comment = $comment;
        $this->id_user = $id_user;
        $this->auditcd = $auditcd;
        $this->userLogin = $userLogin;
    }

    public function getIdComment()
    {
        return $this->id_comment;
    }

    public function setIdComment($id_comment): void
    {
        $this->id_comment = $id_comment;
    }

    public function getIdArticle()
    {
        return $this->id_article;
    }

    public function setIdArticle($id_article): void
    {
        $this->id_article = $id_article;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    public function getAuditcd()
    {
        return $this->auditcd;
    }

    public function setAuditcd($auditcd): void
    {
        $this->auditcd = $auditcd;
    }

    public function getUserLogin()
    {
        return $this->userLogin;
    }





}