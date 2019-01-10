<?php
require_once 'AppController.php';

require_once __DIR__.'/../model/User.php';
require_once __DIR__.'/../model/UserMapper.php';

class AdminController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        if($_SESSION['role'] == 'admin') {
            $user = new UserMapper();
            $this->render('index', ['user' => $user->getUserById($_SESSION['id'])]);
            exit();
        } else {
            $url = "http://$_SERVER[HTTP_HOST]/";
            header("Location: {$url}?page=home");
            exit();
        }
    }

    public function users(): void
    {
        if($_SESSION['role'] == 'admin') {
            $user = new UserMapper();

            header('Content-type: application/json');
            http_response_code(200);

            echo $user->getAllUsers() ? json_encode($user->getAllUsers()) : '';
        }
    }

    public function userDelete(): void
    {
        if($_SESSION['role'] == 'admin') {
            if (!isset($_POST['id_user'])) {
                http_response_code(404);
                return;
            }

            $user = new UserMapper();
            $user->deleteUserById((int)$_POST['id_user']);

            http_response_code(200);
        }
    }
}