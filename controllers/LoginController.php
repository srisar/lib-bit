<?php


class LoginController
{

    /**
     * Shows login page
     * @view:
     * @param Request $request
     */
    public function viewLogin(Request $request)
    {

        if (Session::isUserLoggedIn()) {
            App::redirect('/books');
        }

        if ($request->getParams()->has('error')) {
            View::setError('error', 'Login failed');
        }

        include_once "views/login/login_form.view.php";
    }

    /**
     * @param Request $request
     */
    public function actionProcessLogin(Request $request)
    {

        try {

            $fields = [
                "username" => $request->getParams()->getString('username'),
                "password" => $request->getParams()->getString('password'),
            ];

            $user = User::findUser($fields['username'], $fields['password']);


            if (!empty($user)) {
                Session::setUser($user);
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
    public function actionLogout()
    {
        if (Session::isUserLoggedIn()) {
            Session::killSession();
            App::redirect('/login');
        }
    }

}