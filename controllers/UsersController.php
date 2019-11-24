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

    public function ajax_add_user(Request $request)
    {
        try {

            $response = new JSONResponse();

            $fields = [
                'username' => $request->get_params()->get_string('username'),
                'password_string' => $request->get_params()->get_string('password_string'),
                'display_name' => $request->get_params()->get_string('display_name'),
                'user_role' => $request->get_params()->get_string('user_role'),
            ];


            if (!User::is_username_exist($fields['username'])) {
                $response->add_data($fields);

                $user = new User();
                $user->username = $fields['username'];
                $user->display_name = $fields['display_name'];
                $user->password = $fields['password_string'];
                $user->role = $fields['user_role'];

                if ($user->insert()) {

                    echo $response->to_json();
                    return;
                }

                $response->add_error('User insert failed.');
                echo $response->to_json();
                return;

            } else {
                $response->add_error('Username already exist.');
                echo $response->to_json();
                return;
            }

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }

    }

}