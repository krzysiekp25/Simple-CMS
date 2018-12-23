<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php include(dirname(__DIR__).'/Template/login_panel.php') ?>
<?php include(dirname(__DIR__).'/Template/menu.php') ?>
<?php
print("<a href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=test_session_mapper".">Wyszukiwarka sesji</a></br>");
?>
<h1>Test</h1>
<p>
    <?= $text ?>
<form action="?page=test_session_mapper" method="POST">
    <input type="text" name="id_session"/>
    <input type="submit" value="Szukaj"/>
</form>
</p>
</body>
</html>