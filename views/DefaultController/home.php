<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html'); ?>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <?php include(dirname(__DIR__).'/Template/menu.php') ?>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <?php include(dirname(__DIR__).'/Template/login_panel.php') ?>
            </ul>
        </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-1 sidenav">
            <?php include(dirname(__DIR__).'/Template/topic_menu.php') ?>
        </div>
        <div class="col-sm-11 text-left">

            <h1>Strona główna</h1>
            <p>
                <?php if(isset($text)) {
                    print($text);
                }?>
            </p>
            <hr>
            <?php
            //todo data dodania artykulu
            if(isset($articleList)) {
                /* @var $article Article*/
                foreach ($articleList as $article) {?>
                    <h3>
                        <?php
                        print("<a href=http://"."$_SERVER[HTTP_HOST]"."/"."?page=article&id=".$article->getIdArticle().">".$article->getTitle()."</a>");
                        ?>
                    </h3>
                    <p>
                        <?php
                        print($article->getContent());
                        ?>
                    </p>
                    <?php
                }}
            ?>
        </div>

    </div>
</div>

<footer class="container-fluid text-center">
    <p>Footer Text</p>
</footer>

</body>
</html>