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

        if (Session::is_user_logged_in()) {
            App::redirect('/books');
        }

        if ($request->get_params()->has('error')) {
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
                "username" => $request->get_params()->get_string('username'),
                "password" => $request->get_params()->get_string('password'),
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
        if (Session::is_user_logged_in()) {
            Session::kill_session();
            App::redirect('/login');
        }
    }

}