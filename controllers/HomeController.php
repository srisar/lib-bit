<?php

class HomeController{

    public function home($request){

        $name = isset($_GET['name']) ? $_GET['name'] : "user";
        include "views/home/index.view.php";
    }

    public function about(){
        echo "this is an about page";
    }

    public function contact(){
        echo "this is a contact page";
    }

}