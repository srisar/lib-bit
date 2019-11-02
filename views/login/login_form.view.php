<?php include_once "views/_header.php" ?>

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-6">


            <div class="card bg-dark text-white">

                <div class="card-header"><?php HtmlHelper::render_card_header("Libman: login"); ?></div>

                <div class="card-body">

                    <p>
                        You need a valid login to proceed. Contact administrator for a login detail.
                    </p>

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
                            <button class="btn btn-success">Login</button>
                        </div>

                    </form>

                </div>

            </div>


        </div><!--.col-->

    </div><!--.row-->


</div><!--.container-->

<?php include_once "views/_footer.php" ?>
