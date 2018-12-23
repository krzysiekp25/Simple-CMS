<?php

require_once __DIR__.'/../session/SessionMapper.php';

class TestController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function test_session_mapper()
    {
        $mapper = new SessionMapper();
        if($this->isPost()) {
            $id_session = $_POST['id_session'];
            $text = $mapper->getSessionById($id_session);
            if($text->getIdSession()) {
                $this->render('test', ['text' => unserialize($text->getData())]);
            } else {
                $this->render('test', ['text' => 'brak takiej sesji w bazie']);
            }
        } else {
            $this->render('test', ['text' => 'podaj id szukanej sesji']);
        }
    }

    public function test_session_insert()
    {
        $mapper = new SessionMapper();
        if($this->isPost()) {
            $id_session = $_POST['id_session'];
            $data = $_POST['data'];
            $data2 = [
                "role" => "user",
                "test" => "test value",
            ];
            $status = $mapper->createSession($id_session, serialize($_SESSION));
            if($status) {
                $this->render('test', ['text' => 'Sesja dodana pomyślnie']);
            } else {
                $this->render('test', ['text' => 'Nie udalo sie dodac sesji']);
            }

        } else {
            $this->render('test', ['text' => 'dodaj sesje']);
        }

    }


}