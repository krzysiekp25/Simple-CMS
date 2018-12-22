<?php

require_once 'User.php';
require_once 'Role.php';
require_once 'Address.php';
require_once 'UserDetails.php';
require_once __DIR__.'/../Database.php';

class UserMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getUser(
        string $email
    ):User {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM user u 
                          inner join role r on u.id_role = r.id_role 
                          left join user_details ud on u.id_user_details = ud.id_user_details 
                          left join address a on ud.id_address = a.id_address WHERE u.email = :email;');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            /*ob_start();
            var_dump($result);
            error_log(ob_get_clean());*/
            $role = $result['id_role'] != null ? new Role($result['id_role'], $result['role']): null;
            $address = $result['id_address'] != null ? new Address($result['id_address'], $result['postal_code'], $result['street'], $result['locality'], $result['number']): null;
            $user_details = $result['id_user_details'] != null ? new UserDetails($result['id_user_details'], $address, $result['name'], $result['surname'], $result['phone']): null;
            return new User($result['id_user'], $user_details, $role, $result['email'], $result['login'], $result['password'], $result['salt']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}