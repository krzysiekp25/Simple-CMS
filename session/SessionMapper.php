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

    public function getSessionById(
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

            return new Session($result['id_session'], $result['auditcd'], $result['auditmd'], $result['data']);
        }
        catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    //todo try catch
    public function replaceSession(string $id_session, string $data) {
        $stmt = $this->database->connect()->prepare(
            'REPLACE INTO session (id_session, data) VALUES (:id_session, :data)');
        $stmt->bindParam(':id_session', $id_session, PDO::PARAM_STR);
        $stmt->bindParam(':data', $data, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function deleteSession(string $id_session) {
        $stmt = $this->database->connect()->prepare(
            'DELETE FROM session WHERE id_session = :id_session');
        $stmt->bindParam(':id_session', $id_session, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }


}