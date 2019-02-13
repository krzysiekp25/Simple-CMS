<!DOCTYPE html>
<html lang="pl">

<?php include(dirname(__DIR__) . '/head.html'); ?>
<head>
    <style>
        @media (min-width: 767px) {
            .field-label-responsive {
                padding-top: .5rem;
                text-align: right;
            }
        }
    </style>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/translations/pl.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <?php include(dirname(__DIR__) . '/Template/menu.php') ?>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <?php include(dirname(__DIR__) . '/Template/login_panel.php') ?>
        </ul>
    </div>
</nav>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-sm-12 text-middle">

            <h1>Dodaj artykuł</h1>
            <hr>

            <form class="form-horizontal" role="form" method="POST" action="?page=add_article" id="textEditor">
                <div class="row">

                </div>
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <input type="text" name="title_name" class="form-control" id="titleName"
                                       placeholder="Tytuł" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 mx-auto">
                        <select class="form-control" name="id_topic" required autofocus>
                            <?php
                            if (isset($topicList)) {
                                /* @var $topic Topic */
                                foreach ($topicList as $topic) {
                                    print ('<option value=' . $topic->getIdTopic() . '>');
                                    print ($topic->getTopic());
                                    print('</option>');
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <textarea name="content" id="editor" required>
                            &lt;p&gt;Treść artykułu&lt;/p&gt;
                        </textarea>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fas fa-plus"></i> Dodaj</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


<footer class="container-fluid text-center">
    <?php include(dirname(__DIR__) . '/Template/footer.php'); ?>
</footer>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            language: 'pl'

        })
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>