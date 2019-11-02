<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;


class TestController
{

    public function test()
    {

//       $user = new User();
//       $user->display_name = "Admin";
//       $user->username = "admin";
//       $user->password = "123";
//       $user->role = User::ROLE_ADMIN;
//
//       $user->insert();

        $user = User::find_user("admin", "123");

        if (!empty($user)) {
            Session::set_user($user);
        }

//        Session::kill_session();

        var_dump(Session::is_user_logged_in());

        var_dump($_SESSION);


    }

    public function session_init()
    {
        $_SESSION['color'] = "red";
        $_SESSION['name'] = "kumar";
    }

    public function session_view()
    {
        var_dump($_SESSION);
    }


    public function upload_image()
    {
        include_once 'views/test/upload.view.php';
    }

    public function uploading_image()
    {
        try {

            $request = new Request();

            $files = $request->getFiles()->get('image');

            $uploaded_file = new UploadedFile($files);

            if ($uploaded_file->saveFile()) {

                $uploaded_file_url = $uploaded_file->getUploadedFileUrl();

            }


        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }


}