<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 23.12.2018
 * Time: 00:00
 */

class Address
{
    private $id_address;

    private $postal_code;
    private $street;
    private $locality;
    private $number;

    public function __construct($id_address, $postal_code, $street, $locality, $number)
    {
        $this->id_address = $id_address;
        $this->postal_code = $postal_code;
        $this->street = $street;
        $this->locality = $locality;
        $this->number = $number;
    }

    public function getIdAddress()
    {
        return $this->id_address;
    }

    public function setIdAddress($id_address): void
    {
        $this->id_address = $id_address;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    public function setPostalCode($postal_code): void
    {
        $this->postal_code = $postal_code;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street): void
    {
        $this->street = $street;
    }

    public function getLocality()
    {
        return $this->locality;
    }

    public function setLocality($locality): void
    {
        $this->locality = $locality;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number): void
    {
        $this->number = $number;
    }


}