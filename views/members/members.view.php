<?php include_once "views/_header.php" ?>

<?php

/** @var Member[] $members */
$members = View::getData('members');

/** @var Department[] $departments */
$departments = View::getData('departments');


?>


    <div class="container-fluid">


        <div class="row">

            <div class="col-12 col-xl-3 mb-3">

                <?php include_once BASE_PATH . '/views/members/_add_department.inc.php' ?>


                <div class="card bg-info">
                    <div class="card-header">
                        <?php HtmlHelper::renderCardHeader('Departments') ?>
                    </div>
                    <div class="card-body">

                        <div class="list-group">
                            <?php foreach ($departments as $department): ?>
                                <a class="list-group-item list-group-item-action" href="<?= App::createURL('/members/department', ['dept_id' => $department->id]) ?>">
                                    <?= $department ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div><!--.card-->

            </div>

            <div class="col-12 col-xl-9">


                <div class="card">
                    <div class="card-header"><?php HtmlHelper::renderCardHeader('Recently added members'); ?></div>
                    <div class="card-body">

                        <table class="table table-striped table-bordered data-table-basic">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Department</th>
                                <th>Type</th>
                                <th>Member Since</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php foreach ($members as $member): ?>
                                <tr>
                                    <td>
                                        <a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>">
                                            <?= $member->fullname ?>
                                        </a>
                                    </td>
                                    <td><?= $member->getDepartment() ?></td>
                                    <td><?= $member->member_type ?></td>
                                    <td>
                                        <?= App::toDateString($member->getMemberSince()) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>


                            </tbody>

                        </table>
                    </div>
                </div><!--.card-->


            </div>

        </div>


    </div>

<?php include_once "views/_footer.php" ?>