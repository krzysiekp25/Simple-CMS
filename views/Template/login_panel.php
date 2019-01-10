<?php
if (isset($_SESSION) && !empty($_SESSION)) {
    if ($_SESSION['role'] == 'admin') {
        print("<li class=nav-item><a class=nav-link href=http://" . "$_SERVER[HTTP_HOST]" . "/" . "?page=admin" . "><i class=\"fas fa-tools\"></i> Admin panel</a></li>");
    }
    print("<li class=nav-item><a class=nav-link href=http://" . "$_SERVER[HTTP_HOST]" . "/" . "?page=logout" . "><i class=\"fas fa-sign-out-alt\"></i> Wyloguj</a></li>");
} else {
    print("<li class=nav-item><a class=nav-link href=http://" . "$_SERVER[HTTP_HOST]" . "/" . "?page=login" . "><i class=\"fas fa-sign-in-alt\"></i> Zaloguj</a></li>");
    print("<li class=nav-item><a class=nav-link href=http://" . "$_SERVER[HTTP_HOST]" . "/" . "?page=register" . "><i class=\"fa fa-user-plus\"></i> Zarejestruj</a></li>");
}