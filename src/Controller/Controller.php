<?php 
namespace App\Controller;

use Amadeus\Amadeus;
use Amadeus\Exceptions\ResponseException;

class Controller{
    
    public function sendJson(int $code, array $data = []):string{
        header("HTTP/1.1 ".$code."");
        return json_encode($data);       
    }

    public function __setHeaders(){
        header("Content-Type: application/json");
        header("Allow-Access-Origin: *");
    }

    public function getBody(){
        $body = file_get_contents("php://input");
        return json_decode($body);
    }

}
