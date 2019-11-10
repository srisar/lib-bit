<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;


class TestController
{

    public function test()
    {

        try {
            $image_url = BASE_PATH . BOOK_COVERS_UPLOAD_PATH . '/img.jpg';
            var_dump($image_url);

            $image_processor = new ImageProcessor($image_url);

            $image_processor->resize_exact(400, 600);

            $image_processor->save_image($image_url);

        } catch (AppExceptions $exception) {
            $exception->showMessage();
        }

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

            $files = $request->get_files()->get('image');

            $uploaded_file = new UploadedFile($files);

            if ($uploaded_file->save_file()) {

                $uploaded_file_url = $uploaded_file->get_uploaded_file_url();

            }


        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }


}