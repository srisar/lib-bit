<?php


abstract class Model
{

    public static abstract function selectAll($limit = 100, $offset = 0);

    public static abstract function select($id);

    public abstract function insert();

    public abstract function update();

    public abstract function delete();

}