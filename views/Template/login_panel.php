<?php if(isset($_SESSION) && !empty($_SESSION)) { ?>
    <div>
        <?php
        print("Witaj: ");
        print_r($_SESSION);
        print("Wyloguj: ");
        ?>
    </div>
<?php } else { ?>
    <div>
        <?php print("Zaloguj: ") ?>
    </div>
<?php } ?>