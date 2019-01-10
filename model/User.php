<?php

class User
{

    private $id_user;

    //Encje w relacji
    private $role;


    private $email;
    private $login;
    private $password;

    public function __construct($id_user, $role, $email, $login, $password)
    {
        $this->id_user = $id_user;
        $this->role = $role;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password): void
    {
        $this->password = md5($password);
    }

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login): void
    {
        $this->login = $login;
    }


}