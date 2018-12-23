<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 23.12.2018
 * Time: 14:41
 */
require_once "Session.php";
require_once __DIR__.'/../Database.php';

class SessionMapper
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getSession(
        string $id_session
    ):Session {
        try {
            $stmt = $this->database->connect()->prepare(
                'SELECT * FROM session s WHERE s.id_session = :id_session;');
            $stmt->bindParam(':id_session', $id_session, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            ob_start();
            var_dump($result);
            error_log(ob_get_clean());

            return new Session($result['id_session'], $result['id_user'], $result['auditcd'], $result['auditmd'], $result['data']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}