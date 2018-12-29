<?php
/**
 * Created by PhpStorm.
 * User: Krzysztof
 * Date: 28.12.2018
 * Time: 17:46
 */
require_once __DIR__ . '/../model/CommentMapper.php';
require_once __DIR__ . '/../session/SessionDBHandler.php';

class CommentsController
{

    private $sessionHandler;

    public function postComment()
    {
        if (!empty($_POST["comment"]) && !empty($_POST['id'])) {
            $this->sessionHandler = new SessionDBHandler();
            ob_start();
            var_dump($_SESSION);
            error_log(ob_get_clean());
            $mapper = new CommentMapper();
            $mapper->addComment($_POST['id'], $_POST["comment"], $_SESSION['id']);
            $message = '<label class="text-success">Comment posted Successfully.</label>';
            $status = array(
                'error' => 0,
                'message' => $message
            );
        } else {
            $message = '<label class="text-danger">Error: Comment not posted.</label>';
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
            $this->sessionHandler = new SessionDBHandler();//todo na podstawie sesji wyczaic dla którego komentarza jestem wlascicielem i dodac opcję usunięcia
            ob_start();
            var_dump($_SESSION);
            error_log(ob_get_clean());
            $mapper = new CommentMapper();
            $commentList = $mapper->getCommentsByArticleId($_POST['id']);

            $commentHTML = '';
            /* @var $comment Comment */
            foreach ($commentList as $comment) {
                $commentHTML .= '<div class="panel panel-primary">
<div class="panel-heading">By <b>' . $comment->getUserLogin() . '</b> on <i>' . date("m/d/Y G:i", strtotime($comment->getAuditcd())) . '</i></div>
<div class="panel-body">' . $comment->getComment() . '</div>';
                if(isset($_SESSION) && !empty($_SESSION)) {
                    if ($_SESSION['id'] == $comment->getIdUser() || $_SESSION['role'] == 'admin') {
                        $commentHTML .= '<div class="panel-footer" align="right"><button type="button" class="btn btn-primary delete" id="' . $comment->getIdComment() . '"><i class="fas fa-trash-alt"></i></button></div>';
                    }
                }
                $commentHTML .= '</div> ';
                ob_start();
                var_dump($mapper->getCommentOwnerId($_POST['id']));
                error_log(ob_get_clean());
            }
        } else {
            $message = '<label class="text-danger">Error: Comment not posted.</label>';
            $status = array(
                'error' => 1,
                'message' => $message
            );
        }
        echo $commentHTML;
    }

    public function deleteComment()
    {
        $this->sessionHandler = new SessionDBHandler();
        if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
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