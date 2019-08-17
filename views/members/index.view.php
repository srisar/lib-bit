<?php include_once "views/_header.php" ?>

<?php

/** @var Member[] $members */
$members = View::get_data('members');
/** @var Department[] $departments */
$departments = View::get_data('departments');
/** @var Department $selected_department */
$selected_department = View::get_data('selected_department');

?>


    <div class="container-fluid">

        <div class="row">
            <div class="col">

                <?php if (!empty($selected_department)): ?>
                    <h1 class="text-center">Members in <?= $selected_department ?></h1>
                <?php else: ?>
                    <h1 class="text-center">Recent memebers</h1>
                <?php endif; ?>


            </div>
        </div>

        <div class="row">

            <div class="col-3">

                <div class="card">
                    <div class="card-header">
                        <?= HtmlHelper::render_card_header('Departments') ?>
                    </div>
                    <div class="card-body p-1">

                        <ul class="list-group">
                            <?php foreach ($departments as $department): ?>

                                <li class="list-group-item">
                                    <div class="category-name"><a href="<?= App::createURL('/members/department', ['dept_id' => $department->id]) ?>"><?= $department ?></a></div>

                                </li>
                            <?php endforeach; ?>
                        </ul>

                    </div>
                </div>

            </div>

            <div class="col-9">

                <?php if (empty($members)): ?>
                    <div class="mb-2">
                        <a class="btn btn-sm btn-primary" href="<?= App::createURL('/members/add', ['dept_id' => $selected_department->id]) ?>">
                            Add a new member in <?= $selected_department ?>
                        </a>
                    </div>
                <?php else: ?>

                    <?php if (!empty($selected_department)): ?>
                        <div class="mb-2">
                            <a class="btn btn-sm btn-primary" href="<?= App::createURL('/members/add', ['dept_id' => $selected_department->id]) ?>">
                                Add a new member in <?= $selected_department ?>
                            </a>
                        </div>
                    <?php endif; ?>


                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Member Since</th>
                        </tr>
                        </thead>

                        <tbody>


                        <?php foreach ($members as $member): ?>

                            <tr>
                                <td><a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
                                <td><?= $member->get_member_since() ?></td>
                            </tr>

                        <?php endforeach; ?>


                        </tbody>

                    </table>

                <?php endif; ?>

            </div>

        </div>


    </div>

<?php include_once "views/_footer.php" ?>