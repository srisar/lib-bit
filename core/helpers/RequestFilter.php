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

    /**
     * @param $name
     * @return int
     * @throws AppExceptions
     */
    public function get_int($name): int
    {
        if (isset($this->map[$name])) {
            return (int)filter_var($this->map[$name], FILTER_SANITIZE_NUMBER_INT);
        } else {
            throw new AppExceptions("Field not found: " . $name);
        }
    }

    public function get_float($name): float
    {
        return (float)filter_var($this->map[$name], FILTER_SANITIZE_NUMBER_FLOAT);
    }

    /**
     * @param $name
     * @param bool $filter
     * @return string
     * @throws AppExceptions
     */
    public function get_string($name, $filter = true): string
    {
        if (isset($this->map[$name])) {
            return $filter ? (string)trim(filter_var($this->map[$name], FILTER_SANITIZE_STRING)) : $this->map[$name];
        } else {
            throw new AppExceptions("Field not found: " . $name);
        }


    }

    public function get_email($name)
    {
        return (string)filter_var($this->map[$name], FILTER_VALIDATE_EMAIL);
    }

}