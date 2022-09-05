<?php
declare(strict_types=1);
namespace App\Controller;
use Amadeus\Amadeus;
use Amadeus\Exceptions\ResponseException;

class FlightController extends Controller{

    public function __construct(){
        $this->__setHeaders();
        $this->amadeus = Amadeus::builder($_ENV['AMADEUS_API_KEY'], $_ENV['AMADEUS_API_SECRET'])
        ->build();    
    }

    public function flightOfferSearch($payload){
        try {

            $init = $this->amadeus->getShopping()->getFlightOffers()->get($payload);
            $result = $init[0]->getResponse()->getBody();
            return $result;

        } catch (ResponseException $th) {
            return $th->getMessage();
        }
    }

    public function airportAutocomplete($payload){
        try{    
            
            $init = $this->amadeus->getReferenceData()->getLocations()->get($payload);
            $result = $init[0]->getResponse()->getBody();         
            return $result;
            
        }catch(ResponseException $th){
            throw $th;
        }
    }

    public function flightOfferPrices($payload){
        try {

            $flightOffers = $this->amadeus->getShopping()->getFlightOffers()->get($payload);
            $init = $this->amadeus->getShopping()->getFlightOffers()->getPricing()->postWithFlightOffers($flightOffers);

            $result = $init->getResponse()->getBody();
            return $result;

        } catch (ResponseException $th) {
            throw $th;
        }
    }

    public function flightBooking($payload){
        try {

            $init = $this->amadeus->getBooking()->getFlightOrders()->post($payload);
            $result = $init->getResponse()->getBody();
            return $result;

        } catch (ResponseException $th) {
            print ($th->getMessage());
        }
    }

   
}