<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 25.12.2018
 * Time: 23:19
 */

class AddressMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function insertAddress(string $postal_code, string $street, string $locality, string $number) {
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO address (postal_code, street, locality, number) VALUES (:postal_code, :street, :locality, :number)');
        $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR);
        $stmt->bindParam(':street', $street, PDO::PARAM_STR);
        $stmt->bindParam(':locality', $locality, PDO::PARAM_STR);
        $stmt->bindParam(':number', $number, PDO::PARAM_STR);
        return $stmt->execute();
    }
}