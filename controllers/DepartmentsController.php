<?php


class DepartmentsController
{

    public function adding()
    {
        try {

            $request = new Request();
            $department_name = $request->getParams()->getString('department_name');

            if (empty($department_name)) {

                $members = Member::select_all();
                $departments = Department::select_all();

                View::set_error('error', 'Department name cannot be empty');
                View::set_data('members', $members);
                View::set_data('departments', $departments);

                include_once "views/members/index.view.php";

            } else {

                $existing_dept = Department::select_by_name($department_name);


                if (!empty($existing_dept)) {
                    $members = Member::select_all();
                    $departments = Department::select_all();

                    View::set_error('error', "Department: {$department_name} already exist.");
                    View::set_data('members', $members);
                    View::set_data('departments', $departments);

                    include_once "views/members/index.view.php";

                } else {

                    $department = new Department();
                    $department->department_name = $department_name;

                    if ($department->insert()) {

                        $dept_id = Database::get_last_inserted_id();

                        App::redirect('/members/department', ['dept_id' => $dept_id]);
                    }
                }
            }


        } catch (Exception $ex) {
            die($ex->getMessage());
        }

    }

}