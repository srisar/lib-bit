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


    public function add_data($data)
    {
        array_push($this->data['results'], $data);
    }

    public function add_error($error)
    {
        $this->data['has_error'] = true;
        array_push($this->data['errors'], $error);
    }

    public function to_json()
    {
        return json_encode($this->data);
    }

}