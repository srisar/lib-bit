<?php


class MemberController
{

    public function index()
    {

        try {

            $members = Member::select_all();
            $departments = Department::select_all();

            View::set_data('members', $members);
            View::set_data('departments', $departments);

            include "views/members/index.view.php";


        } catch (Exception $exception) {
            die($exception->getMessage());
        }


    }

    public function edit()
    {

    }

    public function view_by_department()
    {
        try {

            $request = new Request();
            $dept_id = $request->getParams()->getInt('dept_id');

            $department = Department::select($dept_id);

            if(!empty($department)){

                $members = $department->get_all_members();

                View::set_data('departments', Department::select_all());
                View::set_data('members', $members);
                View::set_data('selected_department', $department);

                include "views/members/index.view.php";

            }


        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

}