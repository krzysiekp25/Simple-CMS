<!DOCTYPE html>
<html lang="pl">

<?php include(dirname(__DIR__) . '/head.html'); ?>
<style>
    @media (min-width: 767px) {
        .field-label-responsive {
            padding-top: .5rem;
            text-align: right;
        }
    }
</style>
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

            <h1>Admin Panel</h1>
            <hr>
            <div class="container">
                <div class="row">
                    <h4 class="mt-4">Twoje dane:</h4>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Login</th>
                            <th>Email</th>
                            <th>Rola</th>
                            <th>Akcja</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr><?php /* @var $user User */ ?>
                            <td><?= $user->getLogin(); ?></td>
                            <td><?= $user->getEmail(); ?></td>
                            <td><?= $user->getRole()->getRole(); ?></td>
                            <td>-</td>
                        </tr>
                        </tbody>
                        <tbody class="users-list">
                        </tbody>
                    </table>

                    <button class="btn btn-dark btn-lg" type="button" onclick="getUsers()">Pobierz wszystkich użytkowników</button>
                </div>
            </div>
        </div>

    </div>
</div>


<footer class="container-fluid text-center">
    <?php include(dirname(__DIR__) . '/Template/footer.php'); ?>
</footer>
<script src="/public/scripts/admin_panel.js"></script>
</body>
</html>