<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 25.12.2018
 * Time: 23:20
 */

class UserDetailsMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function insertUserDetails(int $id_address, string $name, string $surname, int $phone) {
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO user_details (id_address, name, surname, phone) VALUES (:id_address, :name, :surname, :phone)');
        $stmt->bindParam(':id_address', $id_address, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_INT);
        $stmt->execute();
        return $this->database->connect()->lastInsertId();
    }



}