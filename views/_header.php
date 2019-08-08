<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="<?= App::getAssetsURL() ?>/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?= App::getAssetsURL() ?>/app.css">
    <link rel="stylesheet" href="<?= App::getAssetsURL() ?>/lineicons/LineIcons.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">LibMan</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">

            <li class="nav-item active">
                <a class="nav-link" href="<?= App::createURL('/books') ?>">Books</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= App::createURL('/categories') ?>">Categories</a>
            </li>
            <li>
                <a class="nav-link" href="<?= App::createURL('/members') ?>">Members</a>
            </li>
        </ul>

    </div>
</nav>
<br>


