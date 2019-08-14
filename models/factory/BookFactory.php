<?php

class BookFactory
{

    private $book;

    public function __construct()
    {
        $this->book = new Book();
    }

    public function add_id($id): BookFactory
    {
        $this->book->id = $id;
        return $this;
    }

    public function add_title($title): BookFactory
    {
        $this->book->title = $title;
        return $this;
    }

    public function add_category_id($category_id): BookFactory
    {
        $this->book->category_id = $category_id;
        return $this;
    }

    public function add_subcategory_id($subcategory_id): BookFactory
    {
        $this->book->subcategory_id = $subcategory_id;
        return $this;
    }

    public function add_image_url($image_url): BookFactory
    {
        $this->book->image_url = $image_url;
        return $this;
    }

    public function build()
    {
        return $this->book;
    }

}
