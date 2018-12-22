<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 22.12.2018
 * Time: 23:58
 */

class UserDetails
{

    private $id_user_details;

    private $address;

    private $name;
    private $surname;
    private $phone;

    public function __construct($id_user_details, $address, $name, $surname, $phone)
    {
        $this->id_user_details = $id_user_details;
        $this->address = $address;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
    }

    public function getIdUserDetails()
    {
        return $this->id_user_details;
    }

    public function setIdUserDetails($id_user_details): void
    {
        $this->id_user_details = $id_user_details;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address): void
    {
        $this->address = $address;
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

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }


}