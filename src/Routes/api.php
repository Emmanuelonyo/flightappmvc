<?php
declare(strict_types=1);
use App\Controller\FlightController;

$app->post("/api/v1/", function($req){

    echo (new FlightController)->flightOfferSearch($req);
    
});