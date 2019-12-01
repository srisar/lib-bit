<?php


class MembersController
{


    public function viewMembers()
    {

        try {

            $members = Member::selectAll();
            $departments = Department::selectAll();

            View::setData('members', $members);
            View::setData('departments', $departments);

            include "views/members/members.view.php";


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }


    }


    public function add(Request $request)
    {
        try {

            $fields = [
                'dept_id' => $request->getParams()->getInt('dept_id'),
                'type' => $request->getParams()->getString('type'),
            ];

            $department = Department::select($fields['dept_id']);


            View::setData('department', $department);
            View::setData('type', $fields['type']);

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
                $member->department_id = $fields['dept_id'];
                $member->fullname = $fields['full_name'];
                $member->member_since = $fields['member_since'];

                if ($member->insert()) {
                    App::redirect('/members/department', ['dept_id' => $fields['dept_id']]);
                }
            } else {
                // Errors in the fields. Render the form again and display error message.

                $department = Department::select($fields['dept_id']);

                View::setError('errors', $errors);
                View::setData('department', $department);
                View::setData('type', $fields['type']);

                include_once "views/members/_modal_add_member_body.php";

            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }


    public function edit_member(Request $request)
    {
        try {
            $id = $request->getParams()->getInt('id');

            $member = Member::select($id);


            View::setData('member', $member);
            View::setData('department', $member->getDepartment());
            View::setData('type', $member->member_type);
            View::setData('member_transactions', $member->getAllBookTransactions());

            include_once "views/members/single.view.php";

        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

    public function editing_member(Request $request)
    {
        try {


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
            AppExceptions::showExceptionView($ex->getMessage());
        }
    }


    public function view_by_department(Request $request)
    {
        try {

            $dept_id = $request->getParams()->getInt('dept_id');

            $department = Department::select($dept_id);

            if (!empty($department)) {
                $students = $department->getAllSudents();
                $teachers = $department->getAllTeachers();

                View::setData('departments', Department::selectAll());
                View::setData('teachers', $teachers);
                View::setData('students', $students);
                View::setData('selected_department', $department);

                include "views/members/department.view.php";
                return;
            } else {
                throw new AppExceptions("Invalid Department");
            }


        } catch (AppExceptions $ex) {
            $ex->showMessage();
        }
    }

}