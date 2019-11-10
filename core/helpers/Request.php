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

    public function get_url(): string
    {
        return $this->domain . $this->path;
    }

    public function get_domain(): string
    {
        return $this->domain;
    }

    public function get_path(): string
    {
        return $this->path;
    }

    public function is_get(): bool
    {
        return $this->method == self::GET;
    }

    public function is_post(): bool
    {
        return $this->method == self::POST;
    }

    /**
     * @return RequestFilter
     */
    public function get_params()
    {
        return $this->params;
    }

    public function get_files(){
        return $this->files;
    }

}