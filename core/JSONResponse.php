<?php


class JSONResponse
{

    private $data;

    public function __construct()
    {
        $this->data = [
            'results' => [],
            'errors' => [],
            'has_error' => false
        ];
    }


    public function addData($data)
    {
        array_push($this->data['results'], $data);
    }

    public function addError($error)
    {
        $this->data['has_error'] = true;
        array_push($this->data['errors'], $error);
    }

    public function toJSON()
    {
        return json_encode($this->data);
    }

}