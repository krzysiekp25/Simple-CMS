<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 28.12.2018
 * Time: 17:46
 */
require_once __DIR__ . '/../model/CommentMapper.php';

class CommentsController extends AppController
{

    public function postComment()
    {
        if (!empty($_POST["comment"]) && !empty($_POST['id'])) {

            ob_start();
            var_dump($_SESSION);
            error_log(ob_get_clean());
            $mapper = new CommentMapper();
            $mapper->addComment($_POST['id'], $_POST["comment"], $_SESSION['id']);
            $message = '<label class="text-success">Dodano komentarz.</label>';
            $status = array(
                'error' => 0,
                'message' => $message
            );
        } else {
            $message = '<label class="text-danger">Błąd: Dodawanie komentarza przerwane.</label>';
            $status = array(
                'error' => 1,
                'message' => $message
            );
        }
        echo json_encode($status);
    }

    public function showComment()
    {
        if (!empty($_POST['id'])) {
            ob_start();
            var_dump($_SESSION);
            error_log(ob_get_clean());
            $mapper = new CommentMapper();
            $commentList = $mapper->getCommentsByArticleId($_POST['id']);

            $commentHTML = '';
            /* @var $comment Comment */
            foreach ($commentList as $comment) {
                $commentHTML .= '<div class="card"><div class="card-header">Autor: <b>' . $comment->getUserLogin() . '</b> dnia: <i>' . date("d/m/Y G:i", strtotime($comment->getAuditcd())) . '</i>';
                if(isset($_SESSION) && !empty($_SESSION)) {
                    if ($_SESSION['id'] == $comment->getIdUser() || $_SESSION['role'] == 'admin') {
                        $commentHTML .= '<button type="button" style="float: right" class="btn btn-primary delete" id="' . $comment->getIdComment() . '"><i class="fas fa-trash-alt"></i></button>';
                    }
                }
                $commentHTML .= '</div> <div class="card-body">' . $comment->getComment() . '</div>';

                ob_start();
                var_dump($mapper->getCommentOwnerId($_POST['id']));
                error_log(ob_get_clean());
            }
        } else {
            $message = '<label class="text-danger">Błąd: Dodawanie komentarza przerwane.</label>';
            $status = array(
                'error' => 1,
                'message' => $message
            );
        }
        echo $commentHTML;
    }

    public function deleteComment()
    {
        if ($this->isPost()) {
            if (isset($_SESSION) && !empty($_SESSION)) {
                $mapper = new CommentMapper();
                ob_start();
                var_dump($mapper->getCommentOwnerId($_POST['id']));
                error_log(ob_get_clean());
                if ($_SESSION['id'] == $mapper->getCommentOwnerId($_POST['id']) || $_SESSION['role'] == 'admin') {
                    $mapper->deleteComment($_POST['id']);
                    $message = '<label class="text-success">Komentarz usunięty.</label>';
                    $status = array(
                        'error' => 0,
                        'message' => $message
                    );
                    echo json_encode($status);
                    exit();
                }
            }
        }
        $message = '<label class="text-danger">Błąd: Brak uprawnień do usunięcia.</label>';
        $status = array(
            'error' => 1,
            'message' => $message
        );
        echo json_encode($status);
        exit();
    }
}