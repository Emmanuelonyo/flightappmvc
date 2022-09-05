<?php
declare(strict_types=1);
use App\Controller\FlightController;
// header("content-Type: application/json");

$app->post("/api/v1/flightOfferSearch", function($req){
    $req = json_decode(file_get_contents("php://input"), true);

     echo (new FlightController)->flightOfferSearch($req);

});

$app->post("/api/v1/airport-list", function($req){
    $req = json_decode(file_get_contents("php://input"), true); 

     echo (new FlightController)->airportAutocomplete($req);

});