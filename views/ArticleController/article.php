<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php include(dirname(__DIR__).'/Template/login_panel.php') ?>
<?php include(dirname(__DIR__).'/Template/menu.php') ?>
<h1>Article</h1>
<p>
    <?= $text ?>
</p>


<?php
if(isset($_SESSION) && !empty($_SESSION)) { ?>
    <div>
        <?php
        print_r("Witaj w artykule zalogowany użytkowniku!");
        ?>
    </div>
<?php } ?>
</body>
</html>