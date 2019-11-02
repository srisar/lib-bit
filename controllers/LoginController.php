<?php


class LoginController
{

    /**
     * Shows login page
     * @view:
     */
    public function login()
    {
        var_dump($_SESSION);
        include_once "views/login/login_form.view.php";
    }

    /**
     * @throws Exception
     */
    public function login_process()
    {


        $request = new Request();

        $fields = [
            "username" => $request->getParams()->getString('username'),
            "password" => $request->getParams()->getString('password'),
        ];

        $user = User::find_user($fields['username'], $fields['password']);

        var_dump($user);

        if (!empty($user)) {
            Session::set_user($user);
        }

    }

    /**
     *
     */
    public function logout()
    {

    }

}