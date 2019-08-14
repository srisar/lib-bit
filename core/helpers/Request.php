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

    public function getUrl(): string
    {
        return $this->domain . $this->path;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function isGet(): bool
    {
        return $this->method == self::GET;
    }

    public function isPost(): bool
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

    public function getFiles(){
        return $this->files;
    }

}