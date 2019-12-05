<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libman - A BIT Project</title>

    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/fonts/fonts.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/app.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/icons/css/all.min.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/plugins/pickerjs/dist/picker.min.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/plugins/DataTables/datatables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
</head>
<body>

<?php if (Session::isUserLoggedIn()): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="<?= App::getBaseURL() ?>/assets/img/logo.png" alt="LibMan" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto" id="main-navbar">

                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::createURL('/books') ?>"><i class="far fa-book"></i> BOOKS</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::createURL('/categories') ?>"><i class="far fa-tags"></i> CATEGORIES</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::createURL('/authors') ?>"><i class="far fa-user-tie"></i> AUTHORS</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::createURL('/members') ?>"><i class="fas fa-users"></i> MEMBERS</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::createURL('/transactions') ?>"><i class="far fa-landmark"></i> TRANSACTIONS</a>
                </li>

            </ul>

            <form class="form-inline my-2 my-lg-0">
                <span class="badge badge-pill badge-dark mr-2">Today is <?= App::todayString() ?></span>

                <?php if (Session::isAdmin()): ?>
                    <a class="btn btn-success my-2 my-sm-0 mr-2" href="<?= App::createURL('/users') ?>">Manage
                        Users</a>
                <?php endif; ?>
                <a class="btn btn-danger my-2 my-sm-0" href="<?= App::createURL('/logout') ?>">Logout</a>

            </form>

        </div>
    </nav>
    <br>
<?php endif; ?>


