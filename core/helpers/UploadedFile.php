<?php


class UploadedFile
{

    private $data;
    private $uploaded_file_path, $full_uploaded_file_path;
    private $uploaded_filename;
    private $is_saved;

    public function __construct($files_image_array)
    {
        $this->data = $files_image_array;
        $this->is_saved = false;
    }

    public function get_name()
    {
        return $this->data['name'];
    }

    public function get_type()
    {
        return $this->data['type'];
    }

    public function get_temp_file()
    {
        return $this->data['tmp_name'];
    }

    public function get_error()
    {
        return $this->data['error'];
    }

    public function get_size()
    {
        return $this->data['size'];
    }

    public function has_error()
    {
        if ($this->get_error() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function get_max_file_upload_size()
    {
        $max_upload_size = ini_get('upload_max_filesize');
        $max_post_size = ini_get('post_max_size');

        var_dump($max_post_size);
        var_dump($max_upload_size);

    }

    public function get_file_extension()
    {
        return explode('/', $this->get_type())[1];
    }

    public function save_file($path)
    {
        $time = time();

        $upload_dir = $path;

        $this->uploaded_filename = sprintf("%d.%s", $time, $this->get_file_extension());
        $this->uploaded_file_path = sprintf("%s/%s", $upload_dir, $this->uploaded_filename);
        $this->full_uploaded_file_path = BASE_PATH . $this->uploaded_file_path;

        $result = move_uploaded_file($this->get_temp_file(), $this->full_uploaded_file_path);

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
    public function get_uploaded_file_url()
    {
        return App::getBaseURL() . $this->uploaded_file_path;
    }

    /**
     * Returns the uploaded file name.
     * @return string
     */
    public function get_uploaded_file_name()
    {
        return $this->uploaded_filename;
    }

    /**
     * Retuns the full uploaded file path in the local system.
     * @return mixed
     */
    public function get_full_uploaded_file_path()
    {
        return $this->full_uploaded_file_path;
    }

}