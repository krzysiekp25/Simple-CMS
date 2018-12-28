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
            /* @var $comment Comment*/
            foreach ($commentList as $comment) {
                $commentHTML .= '
<div class="panel panel-primary">
<div class="panel-heading">By <b>' . $comment->getUserLogin() . '</b> on <i>' . date("m/d/Y G:i", strtotime($comment->getAuditcd())) . '</i></div>
<div class="panel-body">' . $comment->getComment() . '</div>
</div> ';
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
}