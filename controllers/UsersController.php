<?php


class UsersController
{

    public function manage_users(Request $request)
    {

        try {

//            var_dump($_SESSION);

            $users = User::selectAll();
            View::setData('users', $users);


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
                'username' => $request->getParams()->getString('username'),
                'password_string' => $request->getParams()->getString('password_string'),
                'display_name' => $request->getParams()->getString('display_name'),
                'user_role' => $request->getParams()->getString('user_role'),
            ];


            if (!User::isUsernameExists($fields['username'])) {
                $response->addData($fields);

                $user = new User();
                $user->username = $fields['username'];
                $user->display_name = $fields['display_name'];
                $user->password = $fields['password_string'];
                $user->role = $fields['user_role'];

                if ($user->insert()) {

                    echo $response->toJSON();
                    return;
                }

                $response->addError('User insert failed.');
                echo $response->toJSON();
                return;

            } else {
                $response->addError('Username already exist.');
                echo $response->toJSON();
                return;
            }

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }

    }

}