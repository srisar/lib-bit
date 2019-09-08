<?php


class MemberController
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

            include "views/members/index.view.php";


        } catch (Exception $ex) {
            View::set_error('error', $ex->getMessage());
            include "views/error/error.view.php";
        }


    }

    /**
     * Add a new member
     * field: dept_id
     */
    public function add()
    {
        try {

            $request = new Request();

            $fields = [
                'dept_id' => $request->getParams()->getInt('dept_id'),
                'type' => $request->getParams()->getString('type'),
            ];

            $department = Department::select($fields['dept_id']);


            View::set_data('department', $department);
            View::set_data('type', $fields['type']);

            include "views/members/add_member.view.php";

        } catch (Exception $ex) {
            View::set_error('error', $ex->getMessage());
            include "views/error/error.view.php";
        }
    }

    public function adding()
    {
        try {

            $request = new Request();

            $errors = [];

            $fields = [
                'dept_id' => $request->getParams()->getInt('dept_id'),
                'type' => $request->getParams()->getString('type'),
                'full_name' => $request->getParams()->getString('full_name'),
                'member_since' => $request->getParams()->getString('member_since'),
            ];


            // filter inputs!!!
            if (empty($fields['full_name'])) {
                $errors[] = "Full name cannot be empty.";
            }


            if (empty($errors)) {

                // Proceed only if error array is empty.

                $member = new Member();
                $member->member_type = $fields['type'];
                $member->dept_id = $fields['dept_id'];
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

                include_once "views/members/add_member.view.php";

            }


        } catch (Exception $ex) {
            die($ex->getMessage());
//            View::set_error('error', $ex->getMessage());
//            include "views/error/error.view.php";
        }

    }

    /**
     * Show edit member view
     * field: member_id
     */
    public function edit_member()
    {
        try {
            $request = new Request();
            $id = $request->getParams()->getInt('id');

            $member = Member::select($id);


            View::set_data('member', $member);
            View::set_data('department', $member->get_department());
            View::set_data('type', $member->member_type);
            View::set_data('member_transactions', $member->get_all_book_transactions());

            include_once "views/members/edit_member.view.php";

        } catch (Exception $ex) {
            die($ex->getMessage());
        }

    }

    public function editing_member()
    {
        try {

            $request = new Request();

            $fields = [
                'id' => $request->getParams()->getInt('id'),
                'dept_id' => $request->getParams()->getInt('dept_id'),
                'full_name' => $request->getParams()->getString('full_name'),
                'type' => $request->getParams()->getString('type'),
                'member_since' => $request->getParams()->getString('member_since'),
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
            die($ex->getMessage());
        }
    }

    /**
     * Show members by department
     * field: dept_id
     */
    public function view_by_department()
    {
        try {

            $request = new Request();
            $dept_id = $request->getParams()->getInt('dept_id');

            $department = Department::select($dept_id);


            $students = $department->get_all_students();
            $teachers = $department->get_all_teachers();

            View::set_data('departments', Department::select_all());
            View::set_data('teachers', $teachers);
            View::set_data('students', $students);
            View::set_data('selected_department', $department);

            include "views/members/department.view.php";


        } catch (Exception $ex) {
            View::set_error('error', $ex->getMessage());
            include "views/error/error.view.php";
        }
    }

}