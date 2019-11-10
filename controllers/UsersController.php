<?php


class UsersController
{

    public function manage_users(Request $request)
    {

        try {

//            var_dump($_SESSION);

            $users = User::select_all();
            View::set_data('users', $users);


            include_once "views/users/manage_users.view.php";

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }

    }

}