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

    /**
     * @param $name
     * @param bool $filter
     * @return string
     * @throws Exception
     */
    public function getString($name, $filter = true): string
    {
        if (isset($this->map[$name])) {
            return $filter ? (string)trim(filter_var($this->map[$name], FILTER_SANITIZE_STRING)) : $this->map[$name];
        } else {
            throw new Exception("Field not found.");
        }


    }

    public function getEmail($name)
    {
        return (string)filter_var($this->map[$name], FILTER_VALIDATE_EMAIL);
    }

}