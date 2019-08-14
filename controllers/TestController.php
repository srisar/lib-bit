<?php


class TestController
{

    public function test()
    {

        View::set_error('1', 'message a');
        View::set_error('b', 'message b');

        var_dump(View::$error);

        View::render_error_messages('1');

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