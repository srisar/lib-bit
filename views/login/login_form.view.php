<?php include_once "views/_header.php" ?>


<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-12 col-lg-6">


            <div class="card bg-secondary">

                <div class="card-header text-center"><?php HtmlHelper::renderCardHeader("Libman: A library management system"); ?></div>

                <div class="card-body">

                    <?php View::renderErrorMessages(); ?>

                    <div class="text-center">
                        <img class="login-img" src="<?= App::getBaseURL() ?>/assets/img/login.png" alt="Login">
                    </div>

                    <div class="alert alert-dark text-center">
                        You need a valid login to proceed. Contact administrator for a login detail.
                    </div>

                    <form action="<?= App::createURL('/login/process') ?>" method="post">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" type="text" id="username" name="username" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Username</label>
                            <input class="form-control" type="password" id="password" name="password" required>
                        </div>

                        <div class="text-right">
                            <button class="btn btn-success" type="submit">Login</button>
                        </div>

                    </form>

                </div>

            </div>


        </div><!--.col-->

    </div><!--.row-->


</div><!--.container-->

<?php include_once "views/_footer.php" ?>
