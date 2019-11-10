<?php


class MembersController
{

    /**
     * Show members view
     */
    public function index()
    {

        try {

            $members = Member::select_all();
            $departments = Department::select_all();

            View::set_data('members', $members);
            View::set_data('departments', $departments);

            include "views/members/members.view.php";


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }


    }

    /**
     * Add a new member
     * field: dept_id
     * @param Request $request
     */
    public function add(Request $request)
    {
        try {

            $fields = [
                'dept_id' => $request->get_params()->get_int('dept_id'),
                'type' => $request->get_params()->get_string('type'),
            ];

            $department = Department::select($fields['dept_id']);


            View::set_data('department', $department);
            View::set_data('type', $fields['type']);

            include "views/members/_modal_add_member_body.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    public function adding(Request $request)
    {
        try {

            $errors = [];

            $fields = [
                'dept_id' => $request->get_params()->get_int('dept_id'),
                'type' => $request->get_params()->get_string('type'),
                'full_name' => $request->get_params()->get_string('full_name'),
                'member_since' => $request->get_params()->get_string('member_since'),
            ];


            // filter inputs!!!
            if (empty($fields['full_name'])) {
                $errors[] = "Full name cannot be empty.";
            }


            if (empty($errors)) {

                // Proceed only if error array is empty.

                $member = new Member();
                $member->member_type = $fields['type'];
                $member->department_id = $fields['dept_id'];
                $member->fullname = $fields['full_name'];
                $member->member_since = $fields['member_since'];

                if ($member->insert()) {
                    App::redirect('/members/department', ['dept_id' => $fields['dept_id']]);
                }
            } else {
                // Errors in the fields. Render the form again and display error message.

                $department = Department::select($fields['dept_id']);

                View::set_error('errors', $errors);
                View::set_data('department', $department);
                View::set_data('type', $fields['type']);

                include_once "views/members/_modal_add_member_body.php";

            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    /**
     * Show edit member view
     * field: member_id
     * @param Request $request
     */
    public function edit_member(Request $request)
    {
        try {
            $id = $request->get_params()->get_int('id');

            $member = Member::select($id);


            View::set_data('member', $member);
            View::set_data('department', $member->get_department());
            View::set_data('type', $member->member_type);
            View::set_data('member_transactions', $member->get_all_book_transactions());

            include_once "views/members/single.view.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    public function editing_member(Request $request)
    {
        try {


            $fields = [
                'id' => $request->get_params()->get_int('id'),
                'dept_id' => $request->get_params()->get_int('dept_id'),
                'full_name' => $request->get_params()->get_string('full_name'),
                'type' => $request->get_params()->get_string('type'),
                'member_since' => $request->get_params()->get_string('member_since'),
            ];

            $member = Member::select($fields['id']);

            $member->department_id = $fields['dept_id'];
            $member->fullname = $fields['full_name'];
            $member->member_type = $fields['type'];
            $member->member_since = $fields['member_since'];

            if ($member->update()) {
                App::redirect('/members/edit', ['id' => $fields['id']]);
            }

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

    /**
     * Show members by department
     * field: dept_id
     * @param Request $request
     */
    public function view_by_department(Request $request)
    {
        try {

            $dept_id = $request->get_params()->get_int('dept_id');

            $department = Department::select($dept_id);


            $students = $department->get_all_students();
            $teachers = $department->get_all_teachers();

            View::set_data('departments', Department::select_all());
            View::set_data('teachers', $teachers);
            View::set_data('students', $students);
            View::set_data('selected_department', $department);

            include "views/members/department.view.php";


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }

}