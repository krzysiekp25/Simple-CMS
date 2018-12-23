<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 23.12.2018
 * Time: 13:56
 */

require_once "Session.php";
require_once "SessionMapper.php";

class SessionController
{

    public function startSession() {
        session_set_save_handler('_open',
            '_close',
            '_read',
            '_write',
            '_destroy',
            '_clean');
        session_start();
    }

    public function _open()
    {

    }
}