<?php
declare(strict_types=1);
use App\Controller\{
    Controller,
    FlightController
};

$app->post("/api/v1/flight-offer", function($req){ 
     $req = json_decode(file_get_contents("php://input"), true); 
     echo (new FlightController)->flightOfferSearch($req);
});

$app->post("/api/v1/airport-list", function($req){ 
    $req = json_decode(file_get_contents("php://input"), true); 
     echo (new FlightController)->airportAutocomplete($req);
});

$app->post("/api/v1/flight-price", function($req){ 
    $req = json_decode(file_get_contents("php://input"), true); 
     echo (new FlightController)->flightOfferPrices($req);
});

$app->post("/api/v1/flight-booking", function($req){ 
    $req = file_get_contents("php://input"); 
     echo (new FlightController)->flightBooking($req);
});

//HOTEL BOOKING ENDPOINTS 

$app->post("/api/v1/hotel", function($req){ 
    $req = file_get_contents("php://input"); 
     echo (new FlightController)->flightBooking($req);
});