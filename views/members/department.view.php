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

        <!--SIDEBAR: DEPARTMENT-->
        <div class="col-3">


            <div class="card bg-light">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Departments') ?>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($departments as $department): ?>

                            <li class="list-group-item">
                                <div class="category-name"><a href="<?= App::create_url('/members/department', ['dept_id' => $department->id]) ?>"><?= $department ?></a></div>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div><!--.card-->
        </div><!--.col-->
        <!--END SIDEBAR: DEPARTMENT-->

        <div class="col-9">

            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Teachers'); ?> |
                    <button class="btn btn-sm btn-primary" id="btn_show_add_teacher_modal">Add</button>
                </div>
                <div class="card-body">

                    <?php if (!empty($teachers)): ?>
                        <table class="table table-striped table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Member Since</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($teachers as $member): ?>
                                <tr>
                                    <td><a href="<?= App::create_url('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
                                    <td><?= $member->get_member_since() ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No teachers found. Start adding
                            <a href="<?= App::create_url('/members/add', ['dept_id' => $selected_department->id, 'type' => Member::TYPE_TEACHER]) ?>">a new teacher</a>.
                        </p>
                    <?php endif; ?>

                </div>
            </div><!--.card-->

            <br>

            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::render_card_header('Students'); ?> |
                    <button class="btn btn-sm btn-primary" id="btn_show_add_student_modal">Add</button>
                </div>
                <div class="card-body">

                    <?php if (!empty($students)): ?>
                        <table class="table table-striped table-bordered data-table">
                            <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Member Since</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($students as $member): ?>
                                <tr>
                                    <td><a href="<?= App::create_url('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a></td>
                                    <td><?= $member->get_member_since() ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No students found
                            <a href="<?= App::create_url('/members/add', ['dept_id' => $selected_department->id, 'type' => Member::TYPE_STUDENT]) ?>">a new student</a>.
                        </p>
                    <?php endif; ?>
                </div>
            </div><!--.card-->


        </div>

    </div>
</div>


<!--MODAL: Add teacher modal-->

<div class="modal fade" id="modal_add_member" tabindex="-1" role="dialog" aria-labelledby="modal_add_member_title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal_add_member_title">Add new {member type}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php include_once "_modal_add_member_body.php" ?>
            </div>

        </div>
    </div>
</div>


<?php include_once "views/_footer.php" ?>

<script>

    $("#btn_show_add_teacher_modal").on("click", function () {
        $("#modal_add_member_title").text("Add new teacher");
        $("#member_type").val("TEACHER");

        $("#modal_add_member").modal("show");
    });

    $("#btn_show_add_student_modal").on("click", function () {
        $("#modal_add_member_title").text("Add new student");
        $("#member_type").val("STUDENT");
        $("#modal_add_member").modal("show");
    });


</script>