<?php

require_once 'User.php';
require_once 'Role.php';
require_once 'Address.php';
require_once 'UserDetails.php';
require_once 'UserDetailsMapper.php';
require_once __DIR__ . '/../Database.php';

class UserMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getUser(
        string $login
    ): User
    {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM user u 
                          inner join role r on u.id_role = r.id_role 
                          left join user_details ud on u.id_user_details = ud.id_user_details 
                          left join address a on ud.id_address = a.id_address WHERE u.login = :login;');
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            /*ob_start();
            var_dump($result);
            error_log(ob_get_clean());*/
            $role = new Role($result['id_role'], $result['role']);
            $address = new Address($result['id_address'], $result['postal_code'], $result['street'], $result['locality'], $result['number']);
            $user_details = new UserDetails($result['id_user_details'], $address, $result['name'], $result['surname'], $result['phone']);
            return new User($result['id_user'], $user_details, $role, $result['email'], $result['login'], $result['password']);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getUserById(
        int $id
    ): User
    {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM user u 
                          inner join role r on u.id_role = r.id_role WHERE u.id_user = :id_user;');
            $stmt->bindParam(':id_user', $id, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            /*ob_start();
            var_dump($result);
            error_log(ob_get_clean());*/
            $role = new Role($result['id_role'], $result['role']);
            return new User($result['id_user'], 1, $role, $result['email'], $result['login'], $result['password']);
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function getAllUsers(): array
    {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM user u inner join role r on u.id_role = r.id_role WHERE u.id_user != :id;');
            $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ob_start();
            var_dump($result);
            error_log(ob_get_clean());
            return $result;

        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function createUser(string $login, string $email, string $password)
    {
        try {
            $userDetailsMapper = new UserDetailsMapper();
            $idUserDetails = $userDetailsMapper->insertUserDetails(1);//początkowy adres przypisany każdemu userowi

            ob_start();
            var_dump($idUserDetails);
            error_log(ob_get_clean());
            $stmt = $this->database->connect()->prepare(
                'INSERT INTO user (id_user_details, id_role, email, login, password) VALUES (:id_user_details, 1, :email, :login, :password)');
            $stmt->bindParam(':id_user_details', $idUserDetails, PDO::PARAM_INT);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            return $stmt->execute();
        } catch (PDOException $e) {
            return 'Error ' . $e->getMessage();
        }

    }

    public function emailExist(string $email)
    {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM user where email = :email');
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function loginExist(string $login)
    {
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM user where login = :login');
        $stmt->bindParam(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return false;
        }
        return true;
    }

    public function deleteUserById(int $idUser)
    {
        try {
            $connection = $this->database->connect();
            $connection->beginTransaction();
            $stmt1 = $connection->prepare(
                'DELETE FROM comment WHERE id_user = :id_user');
            $stmt1->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmt1->execute();
            $stmt2 = $connection->prepare(
                'DELETE FROM article WHERE owner = :id_user');
            $stmt2->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmt2->execute();
            $stmt3 = $connection->prepare(
                'DELETE FROM user WHERE id_user = :id_user');
            $stmt3->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmt3->execute();
            return $connection->commit();
        } catch (Exception $e) {
            return 'Error ' . $e->getMessage();
        }
    }
}