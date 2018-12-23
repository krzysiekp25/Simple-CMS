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
            $text = $mapper->getSession($id_session);
            if($text->getIdSession()) {
                $this->render('test', ['text' => $text->getAuditcd()]);
            } else {
                $this->render('test', ['text' => 'brak takiej sesji w bazie']);
            }
        } else {
            $this->render('test', ['text' => 'podaj id szukanej sesji']);
        }
    }


}