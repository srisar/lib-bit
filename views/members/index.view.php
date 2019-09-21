<?php include_once "views/_header.php" ?>

<?php

/** @var Member[] $members */
$members = View::get_data('members');

/** @var Department[] $departments */
$departments = View::get_data('departments');


?>


    <div class="container-fluid">


        <div class="row">

            <div class="col-3">

                <?php include_once BASE_PATH . '/views/members/_add_department.inc.php' ?>


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
                </div><!--.card-->

            </div>

            <div class="col-9">


                <div class="card">
                    <div class="card-header"><?php HtmlHelper::render_card_header('Recent members'); ?> (3)</div>
                    <div class="card-body">

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
                    </div>
                </div><!--.card-->


            </div>

        </div>


    </div>

<?php include_once "views/_footer.php" ?>