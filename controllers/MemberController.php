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
            $dept_id = $request->getParams()->getInt('dept_id');

            $department = Department::select($dept_id);


            View::set_data('department', $department);

            include "views/members/add.view.php";

        } catch (Exception $ex) {
            View::set_error('error', $ex->getMessage());
            include "views/error/error.view.php";
        }
    }

    /**
     * Show edit member view
     * field: member_id
     */
    public function edit()
    {

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