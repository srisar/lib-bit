<?php include BASE_PATH . '/views/_header.php'; ?>

<?php

/** @var User[] $users */
$users = View::getData('users');

?>

<div class="container">

    <div class="row justify-content-center">

        <div class="col col-lg-8 mb-3">

            <div class="card">
                <div class="card-header"><?php HtmlHelper::renderCardHeader("Add new user"); ?></div>
                <div class="card-body">

                    <form action="<?= App::createURL('/users/add') ?>" method="post">

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="text_save_display_name">Display Name</label>
                                    <input type="text" name="display_name" class="form-control" value="" id="text_save_display_name">
                                    <div class="invalid-feedback">
                                        Display name cannot be empty.
                                    </div>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="text_save_username">Username</label>
                                    <input type="text" name="username" class="form-control" value="" id="text_save_username">
                                </div>
                            </div>
                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="text_save_password_string">Password</label>
                                    <input type="password" name="password_string" class="form-control" value="" id="text_save_password_string">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="text_save_confirm_password_string">Confirm Password</label>
                                    <input type="password" name="confirm_password_string" class="form-control" value="" id="text_save_confirm_password_string">
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="">User Role</label>
                                    <?php HtmlHelper::renderSelectBox('user_role', User::ROLES, 'select_save_user_role') ?>
                                </div>
                            </div>

                            <div class="w-100"></div>


                            <div class="col text-right">
                                <button class="btn btn-primary" type="button" id="btn_save_user">Save</button>
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
                    <?php HtmlHelper::renderCardHeader('Users'); ?>
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

<script>
    $(function () {

        let textDisplayName = $('#text_save_display_name');
        let textUsername = $('#text_save_username');
        let textPassword = $('#text_save_password_string');
        let textConfirmPassword = $('#text_save_confirm_password_string');
        let selectUserRole = $('#select_save_user_role');
        let buttonSave = $('#btn_save_user');

        buttonSave.on('click', function () {

            let displayName = textDisplayName.val();
            let username = textUsername.val();
            let password = textPassword.val();
            let confirmPassword = textConfirmPassword.val();
            let userRole = selectUserRole.val();

            if (password === "" || username === "" || displayName === "") {
                alert("Required fields cannot be empty.");
            } else if (password !== confirmPassword) {
                alert("Password and confirm password does not match");
            } else {

                $.post(`${getSiteURL()}/index.php/users/add`, {
                    'display_name': displayName,
                    'username': username,
                    'password_string': password,
                    'user_role': userRole
                }).done(function (response) {

                    let json = JSON.parse(response);

                    if (!json.has_error) {
                        alert("User added successfully!");
                        window.location.reload();
                    } else {
                        alert(json.errors[0]);
                    }


                });

            }

            console.log(selectUserRole);
        });


    });
</script>