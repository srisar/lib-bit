<?php


class UploadedFile
{

    private $data;
    private $uploaded_file_path;
    private $uploaded_filename;
    private $is_saved;

    public function __construct($files_image_array)
    {
        $this->data = $files_image_array;
        $this->is_saved = false;
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function getType()
    {
        return $this->data['type'];
    }

    public function getTempFile()
    {
        return $this->data['tmp_name'];
    }

    public function getError()
    {
        return $this->data['error'];
    }

    public function getSize()
    {
        return $this->data['size'];
    }

    public function hasError()
    {
        if ($this->getError() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getMaximumFileUploadSize()
    {
        $max_upload_size = ini_get('upload_max_filesize');
        $max_post_size = ini_get('post_max_size');

        var_dump($max_post_size);
        var_dump($max_upload_size);

    }

    public function getFileExtension()
    {
        return explode('/', $this->getType())[1];
    }

    public function saveFile($path)
    {
        $time = time();

        $upload_dir = $path;

        $this->uploaded_filename = sprintf("%d.%s", $time, $this->getFileExtension());
        $this->uploaded_file_path = sprintf("%s/%s", $upload_dir, $this->uploaded_filename);
        $full_path = BASE_PATH . $this->uploaded_file_path;

        $result = move_uploaded_file($this->getTempFile(), $full_path);

        if ($result) {
            $this->is_saved = true;
            return true;
        }

        return false;

    }

    /**
     * Returns the full uploaded file url
     * @return string
     */
    public function getUploadedFileUrl()
    {
        return App::getBaseURL() . $this->uploaded_file_path;
    }

    /**
     * Returns the uploaded file name.
     * @return string
     */
    public function getUploadedFileName()
    {
        return $this->uploaded_filename;
    }

}