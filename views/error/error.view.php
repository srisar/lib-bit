<?php
$error = View::get_error('error');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exception - Libman</title>

    <style>

        @import url('https://fonts.googleapis.com/css?family=Work+Sans:400,700&display=swap');

        body {
            font-family: "Work Sans", sans-serif;
            font-size: 14px;
            background-color: #dfe4ea;
        }

        .exception-wrapper {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: solid 1px #ccc;
            box-shadow: #cccccc 0 0 10px;
            background-color: #ffffff;
        }

        h1{
            margin: 0;
            text-transform: uppercase;
            color: #ff4757;
            border-bottom: 1px solid #ff4757;
        }

        p{
            font-size: 18px;
            font-family: monospace;
        }


    </style>

</head>
<body>
<div class="exception-wrapper">

    <div class="row text-center justify-content-center">
        <div class="col-6">

            <div class="alert alert-danger">


                <h1>Application Error</h1>
                <p>The following error occurred. If error persist, please contact the developer.</p>
                <p class="lead"><?= $error ?></p>

            </div>

        </div>
    </div>

</div>

</body>
</html>






