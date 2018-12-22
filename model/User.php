<?php

class User
{

    private $id_user;

    //Encje w relacji
    private $user_details;
    private $role;


    private $email;
    private $login;
    private $password;
    private $salt;

    public function __construct($id_user, $user_details, $role, $email, $login, $password, $salt)
    {
        $this->id_user = $id_user;
        $this->user_details = $user_details;
        $this->role = $role;
        $this->email = $email;
        $this->login = $login;
        $this->password = $password;
        $this->salt = $salt;
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

    public function getRole() : Role
    {
        return $this->role;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

    public function getUserDetails()
    {
        return $this->user_details;
    }

    public function setUserDetails($user_details): void
    {
        $this->user_details = $user_details;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login): void
    {
        $this->login = $login;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setSalt($salt): void
    {
        $this->salt = $salt;
    }


}