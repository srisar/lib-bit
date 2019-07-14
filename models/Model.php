<?php


abstract class Model
{

    /*
     * Book::select_all()
     *
     * $b = new Book();
     * ...
     * 4b->insert()
     */

    public static abstract function select_all($limit = 100, $offset = 0);
    public static abstract function select($id);
    public abstract function insert();
    public abstract function update();
    public abstract function delete();

}