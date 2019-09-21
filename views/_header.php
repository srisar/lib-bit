<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Libman - A BIT Project</title>

    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/app.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/lineicons/LineIcons.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/plugins/pickerjs/dist/picker.min.css">
    <link rel="stylesheet" href="<?= App::getBaseURL() ?>/assets/plugins/DataTables/datatables.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><img src="<?= App::getBaseURL() ?>/assets/img/logo.png" alt="LibMan" class="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link" href="<?= App::createURL('/books') ?>">View Books</a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="<?= App::createURL('/categories') ?>">Manage Categories</a>
            </li>
            <li>
                <a class="nav-link active" href="<?= App::createURL('/members') ?>">Manage Members</a>
            </li>
        </ul>

        <form class="form-inline my-2 my-lg-0">
            <span class="badge badge-pill badge-dark mr-2">Today is <?= App::todayString() ?></span>
            <a class="btn btn-success my-2 my-sm-0 mr-2" href="#">Manage Users</a>
            <a class="btn btn-danger my-2 my-sm-0" href="#">Logout</a>
        </form>

    </div>
</nav>
<br>


