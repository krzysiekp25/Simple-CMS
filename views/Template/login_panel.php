<?php
if(isset($_SESSION) && !empty($_SESSION)) { ?>
    <div>
        <?php
        print("Witaj: ");
        print_r($_SESSION);
        print("<a href="."?page=logout".">Wyloguj</a>");
        ?>
    </div>
<?php } else { ?>
    <div>
        <?php
        print("<a href="."?page=login".">Zaloguj</a>");
        ?>
    </div>
<?php } ?>