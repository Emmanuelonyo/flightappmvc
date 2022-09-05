<?php
declare(strict_types=1);
namespace App\Controller;

use Amadeus\Exceptions\ResponseException;

class FlightController extends Controller{

    public function flightOfferSearch($payload){
        try {

            $init = $this->amadeus->getShopping()->getFlightOffers()->get($payload);
            $result = $init[0]->getResponse()->getBody();
            return $result;

        } catch (ResponseException $th) {
            throw $th;
        }
    }

   
}