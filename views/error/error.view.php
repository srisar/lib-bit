<?php include_once "views/_header.php" ?>

<?php
$error = View::get_error('error');
?>


    <div class="container-fluid">

        <div class="row text-center justify-content-center">
            <div class="col-6">

                <div class="alert alert-danger">


                    <h1>Error!</h1>
                    <p class="lead"><?= $error ?></p>
                    <hr>

                </div>

            </div>
        </div>


    </div>

<?php include_once "views/_footer.php" ?>