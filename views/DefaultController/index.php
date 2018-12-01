<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php include(dirname(__DIR__).'/Template/login_panel.php') ?>
<?php include(dirname(__DIR__).'/Template/menu.php') ?>
<h1>HOMEPAGE</h1>
<p>
    <?= $text ?>
</p>


<?php
if(isset($_SESSION) && !empty($_SESSION)) {
    print_r($_SESSION);
}
?>
</body>
</html>