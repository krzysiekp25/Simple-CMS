<?php
print("<li class=nav-item><a class=nav-link href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=home"."><i class=\"fas fa-home\"></i> Strona główna</a></li>");
if(isset($_SESSION) && !empty($_SESSION)) {
    print("<li class=nav-item><a class=nav-link href=http://" . "$_SERVER[HTTP_HOST]" . "/" . "?page=add_article" . "><i class=\"fas fa-plus\"></i> Dodaj artykuł</a></li>");
    if ($_SESSION['role'] == 'admin') {
        print("<li class=nav-item><a class=nav-link href=http://" . "$_SERVER[HTTP_HOST]" . "/" . "?page=add_topic" . "><i class=\"fas fa-folder-plus\"></i> Dodaj temat</a></li>");
    }
}
