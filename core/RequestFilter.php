<?php

class RequestFilter
{

    private $map;

    public function __construct(array $baseMap)
    {
        $this->map = $baseMap;
    }

    public function has($name)
    {
        return isset($this->map[$name]);
    }

    public function get($name)
    {
        return $this->map[$name];
    }

    public function getInt($name): int
    {
        return (int)filter_var($this->map[$name], FILTER_SANITIZE_NUMBER_INT);
    }

    public function getFloat($name): float
    {
        return (float)filter_var($this->map[$name], FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public function getString($name, $filter = true): string
    {
        return $filter ? (string)trim(filter_var($this->map[$name], FILTER_SANITIZE_MAGIC_QUOTES)) : $this->map[$name];
    }

    public function getEmail($name)
    {
        return (string)filter_var($this->map[$name], FILTER_VALIDATE_EMAIL);
    }

}