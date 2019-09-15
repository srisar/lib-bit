<?php

use Carbon\Carbon;
use Carbon\CarbonInterval;


class TestController
{

    public function test()
    {

//        printf("Now: %s", Carbon::now());
//
//        printf("1 day: %s", CarbonInterval::day(5));

        var_dump(new Carbon('2019-08-12'));

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