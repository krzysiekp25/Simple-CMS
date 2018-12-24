<?php
if(isset($_SESSION) && !empty($_SESSION)) {
    if($_SESSION['role']== 'admin') {
        print("<li class=nav-item>
                    <a class=nav-link href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=admin_panel".">Admin panel</a>
                </li>");
    }
    print("<li class=nav-item>
                    <a class=nav-link href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=user_panel".">Ustawienia</a>
                </li>");
    print("<li class=nav-item>
                    <a class=nav-link href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=logout".">Wyloguj</a>
                </li>");
 } else {
    print("<li class=nav-item>
                    <a class=nav-link href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=login".">Zaloguj</a>
                </li>");
    print("<li class=nav-item>
                    <a class=nav-link href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=register".">Zarejestruj</a>
                </li>");
}