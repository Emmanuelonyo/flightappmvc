<?php 
namespace App\Controller;

use Amadeus\Amadeus;
use Amadeus\Exceptions\ResponseException;

class Controller{

    public function __construct()
    {
        $this->amadeus = Amadeus::builder($_ENV['AMADEUS_API_KEY'], $_ENV['AMADEUS_API_SECRET'])
        ->build();        
    }
}