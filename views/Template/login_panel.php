<?php
if(isset($_SESSION) && !empty($_SESSION)) { ?>
    <div>
        <?php
        print("Witaj: ");
        print_r($_SESSION);
        print("<a href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=logout".">Wyloguj</a>");
        ?>
    </div>
<?php } else { ?>
    <div>
        <?php
        print("<a href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=login".">Zaloguj</a>");
        //$url = "http://$_SERVER[HTTP_HOST]/";
        //header("Location: {$url}?page=home");
        ?>
    </div>
<?php } ?>