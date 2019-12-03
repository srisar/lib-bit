<?php

class Request
{

    const GET = 'GET';
    const POST = 'POST';

    private $params, $method, $domain, $path, $cookies, $files;

    public function __construct()
    {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->path = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->params = new RequestFilter($_REQUEST);
        $this->files = new RequestFilter($_FILES);
    }

    /**
     * @return string
     */
    public function getURL(): string
    {
        return $this->domain . $this->path;
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return bool
     */
    public function isGET(): bool
    {
        return $this->method == self::GET;
    }

    /**
     * @return bool
     */
    public function isPOST(): bool
    {
        return $this->method == self::POST;
    }

    /**
     * @return RequestFilter
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @return RequestFilter
     */
    public function getFiles()
    {
        return $this->files;
    }

    public function hasValidImage()
    {
        if ($this->files->has('image')) {
            if ($this->files->get('image')['error'] == 0) return true;
        }

        return false;
    }

}