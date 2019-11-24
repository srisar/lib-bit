<div class="row">
    <div class="col-12">


        <form action="<?= App::create_url('/members/adding') ?>" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="full_name">Full name</label>
                <input type="text" name="full_name" id="full_name" class="form-control" required>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="member_since">Member since</label>
                        <input type="text" name="member_since" id="member_since" class="form-control date-picker" value="<?= App::today_string() ?>">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="full_name">Department</label>
                        <input type="text" value="<?= $selected_department ?>" class="form-control" readonly>
                        <input type="hidden" name="dept_id" value="<?= $selected_department->id ?>">
                    </div>
                </div>
            </div><!--.row-->

            <input type="hidden" name="type" id="member_type" value="<?= Member::TYPE_TEACHER ?>">


            <div class="row">
                <div class="col text-right">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="<?= App::create_url('/members/department', ['dept_id' => $department->id]) ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </div>

        </form>

    </div>
</div>