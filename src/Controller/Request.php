<?php
declare (strict_types=1);

namespace App\Controller;

class Request{

    public function getBody(){
        return file_get_contents("php://input");
    }

    public function getData(){
        return json_decode(file_get_contents("php://input"), true);
    }

    public function getObject(){
        return json_decode(file_get_contents("php://input"));
    }    
}