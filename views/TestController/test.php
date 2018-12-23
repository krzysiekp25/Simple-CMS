<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<?php include(dirname(__DIR__).'/Template/login_panel.php') ?>
<?php include(dirname(__DIR__).'/Template/menu.php') ?>
<?php
print("<a href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=test_session_mapper".">Wyszukiwarka sesji</a></br>");
print("<a href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=test_session_insert".">Dodawanie sesji</a></br>");
?>
<h1>Test</h1>
<p>
    <?php if(isset($text) && is_array($text)) {
        foreach ($text as $value) {
            print($value);
        }
    } ?>

</p>
<?php if($_GET['page'] === 'test_session_mapper')
{
    print('<form action = "?page=test_session_mapper" method = "POST" >
        <input type = "text" name = "id_session" />
        <input type = "submit" value = "Szukaj" /></form >');
}
?>
<?php if($_GET['page'] === 'test_session_insert')
    {
        print('<form action = "?page=test_session_insert" method = "POST" >
        <input type = "text" name = "id_session" />
        <input type = "text" name = "data" />
        <input type = "submit" value = "Dodaj" /></form >');
    } ?>
</body>
</html>