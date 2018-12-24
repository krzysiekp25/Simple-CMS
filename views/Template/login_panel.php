<?php
if(isset($_SESSION) && !empty($_SESSION)) { ?>
        <div class="btn-group dropleft float-right">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php
                print("Witaj ".$_SESSION['name']."</br>");
                ?>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <?php
                    if($_SESSION['role']== 'admin') {
                        print("<a class=dropdown-item href=http://" . "$_SERVER[HTTP_HOST]" . "/" . "?page=admin_panel" . ">Admin panel</a>");
                    }
                    print("<a class=dropdown-item href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=user_panel".">Ustawienia</a>");
                    print("<a class=dropdown-item href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=logout".">Wyloguj</a>");
                    ?>
            </div>
        </div>
<?php } else { ?>
    <div class="btn-group dropleft float-right">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Witaj nieznajomy
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <?php
            print("<a class=dropdown-item href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=login".">Zaloguj</a>");
            print("<a class=dropdown-item href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=register".">Zarejestruj</a>");
            ?>
        </div>
    </div>
<?php } ?>