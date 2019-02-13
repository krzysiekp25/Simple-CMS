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

            <h1>Rejestracja</h1>
            <hr>

            <form class="form-horizontal" role="form" method="POST" action="?page=register">
                <div class="row">
                    <div class="col-md-3 field-label-responsive">
                        <label for="login">Login</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-user"></i></div>
                                <input type="text" name="login" class="form-control" id="login"
                                       placeholder="Login" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <?php if (isset($loginErrorMessage)): ?><i class="fas fa-times">
                                <?php print($loginErrorMessage) ?>
                                </i><?php endif; ?>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 field-label-responsive">
                        <label for="email">Adres E-Mail</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-at"></i></div>
                                <input type="text" name="email" class="form-control" id="email"
                                       placeholder="jan@kowalski.pl" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <!-- Put e-mail validation error messages here -->
                            <?php if (isset($emailErrorMessage)): ?><i class="fas fa-times">
                                <?php print($emailErrorMessage) ?>
                                </i><?php endif; ?>
                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 field-label-responsive">
                        <label for="password">Password</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group has-danger">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem"><i class="fa fa-key"></i></div>
                                <input type="password" name="password" class="form-control" id="password"
                                       placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-control-feedback">
                        <span class="text-danger align-middle">
                            <?php if (isset($passwordErrorMessage)): ?><i class="fas fa-times">
                                <?php print($passwordErrorMessage) ?>
                                </i><?php endif; ?>

                        </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 field-label-responsive">
                        <label for="password">Confirm Password</label>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon" style="width: 2.6rem">
                                    <i class="fas fa-redo-alt"></i>
                                </div>
                                <input type="password" name="password-confirmation" class="form-control"
                                       id="password-confirm" placeholder="Password" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Register</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<footer class="container-fluid text-center">
    <?php include(dirname(__DIR__) . '/Template/footer.php'); ?>
</footer>

</body>
</html>