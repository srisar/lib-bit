<?php


class LoginController
{

    /**
     * Shows login page
     * @view:
     * @param Request $request
     */
    public function login(Request $request)
    {

        if ($request->getParams()->has('error')) {
            View::set_error('error', 'Login failed');
        }

        include_once "views/login/login_form.view.php";
    }

    /**
     * @param Request $request
     */
    public function login_process(Request $request)
    {

        try {

            $fields = [
                "username" => $request->getParams()->getString('username'),
                "password" => $request->getParams()->getString('password'),
            ];

            $user = User::find_user($fields['username'], $fields['password']);


            if (!empty($user)) {
                Session::set_user($user);
                App::redirect('/books');
            } else {
                App::redirect('/login', ['error' => '1']);
            }

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }

    }

    /**
     *
     */
    public function logout()
    {

    }

}