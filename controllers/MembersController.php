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


    public function actionAddingMember(Request $request)
    {

        $response = new JSONResponse();

        try {


            $fields = [
                'dept_id' => $request->getParams()->getInt('dept_id'),
                'member_type' => $request->getParams()->getString('member_type'),
                'full_name' => $request->getParams()->getString('full_name'),
                'member_since' => $request->getParams()->getString('member_since'),
            ];

            $member = new Member();
            $member->member_type = $fields['member_type'];
            $member->department_id = $fields['dept_id'];
            $member->fullname = $fields['full_name'];
            $member->member_since = $fields['member_since'];


            if ($member->insert()) {
                $response->addData(Member::select(Database::getLastInsertedId()));
                echo $response->toJSON();
                return;
            } else {
                $response->addError("Insert failed.");
                echo $response->toJSON();
                return;
            }


        } catch (Exception $ex) {
            $response->addError($ex->getMessage());
            echo $response->toJSON();
            return;
        }

    }


    public function viewEditMember(Request $request)
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

    public function actionEditingMember(Request $request)
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


    public function viewMembersByDepartment(Request $request)
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