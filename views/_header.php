<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libman - A BIT Project</title>

    <link rel="stylesheet" href="<?= App::get_base_url() ?>/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= App::get_base_url() ?>/assets/app.css">
    <link rel="stylesheet" href="<?= App::get_base_url() ?>/assets/lineicons/LineIcons.css">
    <link rel="stylesheet" href="<?= App::get_base_url() ?>/assets/plugins/pickerjs/dist/picker.min.css">
    <link rel="stylesheet" href="<?= App::get_base_url() ?>/assets/plugins/DataTables/datatables.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

<?php if (Session::is_user_logged_in()): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">
            <img src="<?= App::get_base_url() ?>/assets/img/logo.png" alt="LibMan" class="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::create_url('/books') ?>">View Books</a>
                </li>

                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Manage Books
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= App::create_url('/categories') ?>">Manage Categories</a>
                        <a class="dropdown-item" href="<?= App::create_url('/authors') ?>">Manage Authors</a>

                    </div>
                </li>


                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::create_url('/members') ?>">Manage Members</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="<?= App::create_url('/transactions') ?>">View Transactions</a>
                </li>

            </ul>

            <form class="form-inline my-2 my-lg-0">
                <span class="badge badge-pill badge-dark mr-2">Today is <?= App::today_string() ?></span>

                <?php if (Session::is_admin()): ?>
                    <a class="btn btn-success my-2 my-sm-0 mr-2" href="<?= App::create_url('/users') ?>">Manage
                        Users</a>
                <?php endif; ?>
                <a class="btn btn-danger my-2 my-sm-0" href="<?= App::create_url('/logout') ?>">Logout</a>

            </form>

        </div>
    </nav>
    <br>
<?php endif; ?>


