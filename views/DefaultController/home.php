<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>

<body>
<div>
<?php include(dirname(__DIR__).'/Template/login_panel.php') ?>


<?php include(dirname(__DIR__).'/Template/menu.php') ?>
<h1>Strona główna</h1>

    <?= $text ?>


    <?php
    /* @var $article Article*/
    foreach ($articleList as $article) {?>
        <div>
        <p>
            <?php
            print($article->getTitle())
            ?>
        </p>
        </div>
        <?php
    }
    ?>


<?php
if(isset($_SESSION) && !empty($_SESSION)) {
    print_r($_SESSION);
    if(isset($_GET['number'])) {
        print($_GET['number']);
    }
}
?>
</div>
<!--Skrypty dla poprawnego działania bootstrapa-->
<?php include(dirname(__DIR__).'/Template/bootstrapJs.php') ?>
</body>
</html>