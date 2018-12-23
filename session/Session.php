<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 23.12.2018
 * Time: 14:41
 */

class Session
{
    private $id_session;
    private $id_user;
    private $auditcd;
    private $auditmd;
    private $data;

    public function __construct($id_session, $id_user, $auditcd, $auditmd, $data)
    {
        $this->id_session = $id_session;
        $this->id_user = $id_user;
        $this->auditcd = $auditcd;
        $this->auditmd = $auditmd;
        $this->data = $data;
    }

    public function getIdSession()
    {
        return $this->id_session;
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function getAuditcd()
    {
        return $this->auditcd;
    }

    public function getAuditmd()
    {
        return $this->auditmd;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setIdSession($id_session): void
    {
        $this->id_session = $id_session;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    public function setData($data): void
    {
        $this->data = $data;
    }




}