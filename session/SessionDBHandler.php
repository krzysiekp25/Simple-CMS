<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 23.12.2018
 * Time: 13:56
 */

require_once "Session.php";
require_once "SessionMapper.php";

class SessionDBHandler
{
    private $mapper;

    function __construct ()
    {
        $this->mapper = new SessionMapper();

        session_set_save_handler(
            array($this,'open'),
            array($this,'close'),
            array($this,'read'),
            array($this,'write'),
            array($this,'destroy'),
            array($this,'gc')
        );

        session_start();
    }

    public function open()
    {
        if($this->mapper) {
            return true;
        }
        return false;
    }

    public function read($id)
    {
        $session = $this->mapper->getSessionById($id);
        if(is_null($session->getData())) {
            return '';
        } else {
            return $session->getData();
        }


    }

    public function write($id, $data)
    {
        $mapper = new SessionMapper();
        return $mapper->replaceSession($id, $data);
        //insert data to DB, take note of serialize
    }

    public function destroy($id)
    {
        //MySql delete sessions where ID = $id
        $mapper = new SessionMapper();
        return $mapper->deleteSession($id);
    }

    public function gc()
    {
        return true;
    }
    public function close()
    {
        return true;
    }
}