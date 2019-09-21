<?php include_once "views/_header.php" ?>

<?php
/** @var Department $department */
$department = View::get_data('department');
$type = View::get_data('type');

$errors = View::get_error('errors');

?>


    <div class="container-fluid">

        <div class="row">
            <div class="col-4">

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-warning mb-3">
                        <p class="font-weight-bold">Correct the following errors</p>
                        <?php foreach ($errors as $error): ?>
                            <li><?= $error ?></li>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <div class="card-header">
                        <?php HtmlHelper::render_card_header("Add a new {$type}") ?>
                    </div>
                    <div class="card-body">

                        <form action="<?= App::createURL('/members/adding') ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="full_name">Full name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" required>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="member_since">Member since</label>
                                        <input type="text" name="member_since" id="member_since" class="form-control date-picker" value="<?= App::todayString() ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="full_name">Department</label>
                                        <input type="text" value="<?= $department ?>" class="form-control" readonly>
                                        <input type="hidden" name="dept_id" value="<?= $department->id ?>">
                                    </div>
                                </div>
                            </div><!--.row-->

                            <input type="hidden" name="type" value="<?= $type ?>">


                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?= App::createURL('/members/department', ['dept_id' => $department->id]) ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>


            </div>
        </div>


    </div>

<?php include_once "views/_footer.php" ?>