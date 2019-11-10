<?php include BASE_PATH . '/views/_header.php'; ?>

<?php

/** @var User[] $users */
$users = View::get_data('users');

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col col-lg-8 mb-3">

            <div class="card">
                <div class="card-header"><?php HtmlHelper::render_card_header("Add new user"); ?></div>
                <div class="card-body">

                    <form action="" method="post">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">User Name</label>
                                    <input type="text" name="author_name" class="form-control" value="" id="text_save_author_name">
                                    <div class="invalid-feedback">
                                        Author name cannot be empty.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" name="author_email" class="form-control" value=""
                                           id="text_save_author_email">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col text-right">
                                <button class="btn btn-primary" type="button" id="btn_save_author">Save</button>
                            </div>
                        </div>

                    </form>

                </div><!--.card-body-->
            </div><!--.card-->
        </div><!--.col-->

        <div class="w-100"></div>

        <div class="col col-lg-8">

            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Users'); ?>
                </div>
                <div class="card-body p-2">

                    <table class="data-table table table-striped">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Username</th>
                            <th>Role</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td>
                                    <a href="#" id="<?= $user->id ?>" class="item_author"><?= $user->display_name ?></a>
                                </td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->role ?></td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>

                </div><!--.card-body-->
            </div><!--.card-->
        </div><!--.col-->
    </div><!--.row-->

</div><!--.container-->

<?php include BASE_PATH . '/views/_footer.php'; ?>
