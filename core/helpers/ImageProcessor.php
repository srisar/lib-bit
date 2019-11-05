<?php


class ImageProcessor
{

    private $image, $image_path;
    private $image_width, $image_height;
    private $mime, $ext;

    private $temp_image;

    /**
     * ImageProcessor constructor.
     * @param $image_file
     * @throws AppExceptions
     */
    public function __construct($image_file)
    {
        if (file_exists($image_file)) {

            $size = getimagesize($image_file);

            // DEBUG
            var_dump($size);

            $this->mime = $size['mime'];

            if ($this->is_valid_image($image_file)) {
                $this->image_height = imagesy($this->image);
                $this->image_width = imagesx($this->image);
            } else {
                throw new AppExceptions("File is not a valid image (jpg, png or gif)");
            }

        } else {
            throw new AppExceptions("Image does not exist.");
        }
    }

    /**
     * Checks if the image file is a valid image
     * valid images are of type: jpg, png and gif
     * @param $image_file
     * @return bool
     */
    private function is_valid_image($image_file)
    {
        if ($this->mime == 'image/jpg' || $this->mime == 'image/jpeg') {
            $this->image = imagecreatefromjpeg($image_file);
            $this->ext = 'jpg';
            return true;

        } elseif ($this->mime == 'image/png') {
            $this->image = imagecreatefrompng($image_file);
            $this->ext = 'png';
            return true;

        } elseif ($this->mime == 'image/gif') {
            $this->image = imagecreatefromgif($image_file);
            $this->ext = 'gif';
            return true;
        }
        return false;
    }

    public function save_image($path, $quality = 100)
    {
        if ($this->mime == 'image/jpg' || $this->mime == 'image/jpeg') {
            imagejpeg($this->temp_image, $path, $quality);


        } elseif ($this->mime == 'image/png') {
            imagepng($this->temp_image, $path);

        } elseif ($this->mime == 'image/gif') {
            imagegif($this->temp_image);
        }

        imagedestroy($this->temp_image);

    }

    public function resize_exact($width, $height)
    {
        $this->temp_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($this->temp_image, $this->image, 0, 0, 0, 0, $width, $height, $this->image_width, $this->image_height);

    }

    public function resize_max_width($max_width)
    {
        $ratio = $max_width / $this->image_width;
        $new_height = $this->image_height * $ratio;

        $this->temp_image = imagecreatetruecolor($max_width, $new_height);
        imagecopyresampled($this->temp_image, $this->image, 0, 0, 0, 0, $max_width, $new_height, $this->image_width, $this->image_height);

    }

    public function resize_max_height($max_height)
    {
        $ratio = $max_height / $this->image_height;
        $new_width = $this->image_width * $ratio;

        $this->temp_image = imagecreatetruecolor($new_width, $max_height);
        imagecopyresampled($this->temp_image, $this->image, 0, 0, 0, 0, $new_width, $max_height, $this->image_width, $this->image_height);

    }


}