<?php

require_once 'User.php';
require_once 'Role.php';
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
                          inner join role r on u.id_role = r.id_role WHERE u.login = :login;');
            $stmt->bindParam(':login', $login, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            /*ob_start();
            var_dump($result);
            error_log(ob_get_clean());*/
            $role = new Role($result['id_role'], $result['role']);
            return new User($result['id_user'], $role, $result['email'], $result['login'], $result['password']);
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
            return new User($result['id_user'], $role, $result['email'], $result['login'], $result['password']);
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
            $stmt = $this->database->connect()->prepare(
                'INSERT INTO user (id_role, email, login, password) VALUES (1, :email, :login, :password)');
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
            $stmt0 = $connection->prepare('SELECT a.id_article FROM article a WHERE a.owner = :id_user');
            $stmt0->bindParam(':id_user', $idUser, PDO::PARAM_INT);
            $stmt0->execute();
            $articleIdResult = $stmt0->fetchAll(PDO::FETCH_NUM);
            $articleIdList = [];
            foreach ($articleIdResult as $item) {
                foreach ($item as $id) {
                    array_push($articleIdList, $id);
                }
            }
            ob_start();
            var_dump($articleIdList);
            error_log(ob_get_clean());
            $inQuery = implode(',', array_fill(1, count($articleIdList), '?'));
            ob_start();
            var_dump($inQuery);
            error_log(ob_get_clean());
            $stmt1 = $connection->prepare(
                'DELETE FROM comment WHERE id_user = ? OR id_article IN (' . $inQuery . ')');
            $stmt1->bindParam(1, $idUser, PDO::PARAM_INT);
            foreach ($articleIdList as $k => $id) {
                $stmt1->bindValue(($k + 2), $id);
            }
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