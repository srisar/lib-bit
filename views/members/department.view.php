<?php include_once "views/_header.php" ?>

<?php

/** @var Member[] $members */
$teachers = View::getData('teachers');
/** @var Member[] $students */
$students = View::getData('students');

/** @var Department[] $departments */
$departments = View::getData('departments');
/** @var Department $selected_department */
$selected_department = View::getData('selected_department');


?>


<div class="container-fluid">

    <div class="row">
        <div class="col">
            <h1 class="text-center">Members in <?= $selected_department ?></h1>
        </div>
    </div>

    <div class="row">

        <!--SIDEBAR: DEPARTMENT-->
        <div class="col-2">

            <div class="card">
                <div class="card-header">
                    <?php HtmlHelper::renderCardHeader('Departments') ?>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <?php foreach ($departments as $department): ?>

                            <?php $selected = ($department->id == $selected_department->id) ? "active" : ""; ?>

                            <a class="list-group-item list-group-item-action <?= $selected ?>" href="<?= App::createURL('/members/department', ['dept_id' => $department->id]) ?>">
                                <?= $department ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div><!--.card-->
        </div><!--.col-->
        <!--END SIDEBAR: DEPARTMENT-->

        <div class="col-10">

            <div class="row">
                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <?php HtmlHelper::renderCardHeader('Teachers'); ?> |
                            <button class="btn btn-sm btn-primary btn_show_add_teacher_modal">Add</button>
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
                                            <td>
                                                <a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a>
                                            </td>
                                            <td><?= $member->getMemberSince() ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>No teachers found. Start adding <a href="#" class="btn_show_add_teacher_modal">a new teacher</a>.</p>
                            <?php endif; ?>

                        </div>
                    </div><!--.card-->
                </div><!--.col-->

                <div class="col-12 col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <?php HtmlHelper::renderCardHeader('Students'); ?> |
                            <button class="btn btn-sm btn-primary btn_show_add_student_modal">Add</button>
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
                                            <td>
                                                <a href="<?= App::createURL('/members/edit', ['id' => $member->id]) ?>"><?= $member->fullname ?></a>
                                            </td>
                                            <td><?= $member->getMemberSince() ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else: ?>
                                <p>No students found. Start adding <a href="#" class="btn_show_add_student_modal">a new student</a>.</p>
                            <?php endif; ?>
                        </div>
                    </div><!--.card-->
                </div><!--.col-->
            </div>


        </div>

    </div>
</div>


<!--MODAL: Add teacher modal-->

<div class="modal fade" id="modal_add_member" tabindex="-1" role="dialog" aria-labelledby="modal_add_member_title"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal_add_member_title">Add new {member type}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">

                        <!--FORM: Add Member-->
                        <form>

                            <div class="form-group">
                                <label for="full-name">Full name</label>
                                <input type="text" id="full-name" class="form-control" required>
                                <div class="invalid-feedback">Full name is required.</div>
                                <div class="valid-feedback">Looks good!</div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="member-since">Member since</label>
                                        <input type="text" id="member-since" class="form-control date-picker" value="<?= App::todayString() ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="department-name">Department</label>
                                        <input type="text" id="department-name" value="<?= $selected_department ?>" class="form-control" readonly>
                                        <input type="hidden" id="dept-id" value="<?= $selected_department->id ?>">
                                    </div>
                                </div>
                            </div><!--.row-->

                            <input type="hidden" name="type" id="member-type" value="<?= Member::TYPE_TEACHER ?>">


                            <div class="row">
                                <div class="col text-right">
                                    <button type="button" class="btn btn-primary" id="btn-save-member">Save</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>

                        </form>
                        <!--END FORM-->

                        <div class="">
                            <div id="form-messages" class="text-danger"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<?php include_once "views/_footer.php" ?>

<script>

    function showAddMemberModal(memberType, title) {
        $("#modal_add_member_title").text(title);
        $("#member-type").val(memberType);
        $("#modal_add_member").modal("show");
    }

    $(function () {

        let textFullName = $("#full-name");
        let textDepartmentId = $("#dept-id");
        let textMemberSince = $("#member-since");
        let textMemberType = $("#member-type");
        let btnSaveMember = $("#btn-save-member");
        let formMessages = $("#form-messages");

        $(".btn_show_add_teacher_modal").on("click", function () {
            showAddMemberModal("TEACHER", "Add Teacher");
        });

        $(".btn_show_add_student_modal").on("click", function () {
            showAddMemberModal("STUDENT", "Add Student");
        });

        /**
         * Validate member name
         */
        textFullName.on("keyup", function () {
            if (!validateForEmptyField(textFullName)) {
                disableField(btnSaveMember);
            } else {
                enableField(btnSaveMember);
            }
        });

        /**
         * Process save member
         */
        btnSaveMember.on("click", function () {

            if (validateForEmptyField(textFullName)) {

                $.post(`${getSiteURL()}/index.php/members/adding`, {
                    'full_name': textFullName.val(),
                    'dept_id': textDepartmentId.val(),
                    'member_since': textMemberSince.val(),
                    'member_type': textMemberType.val()
                }).done(function (data) {

                    let response = JSON.parse(data);

                    console.log(response);

                    if (response.has_error) {
                        formMessages.empty();
                        formMessages.append(buildMessageList(response.errors));
                    } else {
                        alert("Member added successfully!");
                        window.location.reload();
                    }

                });


            }


        });

    });

</script>