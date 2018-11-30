<?php

class User
{
    private $id_user;
    private $name;
    private $surname;
    private $email;
    private $password;
    private $role;

    public function __construct($id_user, $name, $surname, $email, $password, $role)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        $this->id_user = $id_user;
        $this->role = $role;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname): void
    {
        $this->surname = $surname;
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

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role): void
    {
        $this->role = $role;
    }

}