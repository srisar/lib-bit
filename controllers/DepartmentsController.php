<?php


class DepartmentsController
{

    public function adding(Request $request)
    {
        try {

            $department_name = $request->getParams()->getString('department_name');

            if (empty($department_name)) {

                $members = Member::selectAll();
                $departments = Department::selectAll();

                View::setError('error', 'Department name cannot be empty');
                View::setData('members', $members);
                View::setData('departments', $departments);

                include_once "views/members/members.view.php";

            } else {

                $existing_dept = Department::selectByName($department_name);


                if (!empty($existing_dept)) {
                    $members = Member::selectAll();
                    $departments = Department::selectAll();

                    View::setError('error', "Department: {$department_name} already exist.");
                    View::setData('members', $members);
                    View::setData('departments', $departments);

                    include_once "views/members/members.view.php";

                } else {

                    $department = new Department();
                    $department->department_name = $department_name;

                    if ($department->insert()) {

                        $dept_id = Database::getLastInsertedId();

                        App::redirect('/members/department', ['dept_id' => $dept_id]);
                    }
                }
            }


        } catch (Exception $ex) {
            AppExceptions::showExceptionView($ex->getMessage());
        }

    }

}