<?php
if(isset($topicList)) {
    /* @var $topic Topic */
    foreach ($topicList as $topic) {
        print("<p><a href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=topic&id=".$topic->getIdTopic().">".$topic->getTopic()."</a></p>");
    }
}