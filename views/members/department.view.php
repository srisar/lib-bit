<?php include_once "views/_header.php" ?>

<?php

/** @var Member[] $members */
$teachers = View::get_data('teachers');
/** @var Member[] $students */
$students = View::get_data('students');

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
                <h1 class="text-center">Recent members</h1>
            <?php endif; ?>


        </div>
    </div>

    <div class="row">

        <div class="col-3">

            <div class="card bg-light">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Departments') ?>
                </div>
                <div class="card-body">

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


            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Teachers'); ?> |
                    <a href="<?= App::createURL('/members/add', ['dept_id' => $selected_department->id, 'type' => Member::TYPE_TEACHER]) ?>" class="btn btn-sm btn-success">Add</a>
                </div>
                <div class="card-body">

                    <?php if (!empty($students)): ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Member Since</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($teachers as $member): ?>
                                <tr>
                                    <td><a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
                                    <td><?= $member->get_member_since() ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No teachers found. Start adding
                            <a href="<?= App::createURL('/members/add', ['dept_id' => $selected_department->id, 'type' => Member::TYPE_TEACHER]) ?>">a new teacher</a>.
                        </p>
                    <?php endif; ?>

                </div>
            </div><!--.card-->

            <br>

            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Students'); ?> |
                    <a href="<?= App::createURL('/members/add', ['dept_id' => $selected_department->id, 'type' => Member::TYPE_STUDENT]) ?>" class="btn btn-sm btn-success">add</a>
                </div>
                <div class="card-body">

                    <?php if (!empty($students)): ?>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Member Since</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($students as $member): ?>
                                <tr>
                                    <td><a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
                                    <td><?= $member->get_member_since() ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No students found
                            <a href="<?= App::createURL('/members/add', ['dept_id' => $selected_department->id, 'type' => Member::TYPE_STUDENT]) ?>">a new student</a>.
                        </p>
                    <?php endif; ?>
                </div>
            </div><!--.card-->


        </div>

    </div>


</div>

<?php include_once "views/_footer.php" ?>
