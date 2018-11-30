<!DOCTYPE html>
<html>

<?php include(dirname(__DIR__).'/head.html') ?>

<body>
<?php include(dirname(__DIR__).'/Template/login_panel.php') ?>
<h1>PLAYER</h1>

<?php foreach($videos as $video): ?>

    <video height="200" controls>
        <source src="../../public/upload/<?= $video ?>" type="video/mp4">
    </video>

<?php endforeach; ?>

</body>
</html>