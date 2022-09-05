<?php
declare(strict_types=1);
namespace App\Controller;
use Amadeus\Exceptions\ResponseException;

class FlightController extends Controller{

    public function flightOfferSearch($payload){
        try {

            $init = $this->amadeus->getShopping()->getFlightOffers()->get($payload);           
            $result = $this->flightOfferPrices($init);
            
            return json_encode($result);

        } catch (ResponseException $th) {
            return $th->getMessage();
        }
    }

    public function airportAutocomplete($payload){
        try{    

            $init = $this->amadeus->getReferenceData()->getLocations()->get($payload);
            $result = $init[0]->getResponse()->getData();
            return json_encode($result);
            
        }catch(ResponseException $th){
            throw $th;
        }
    }

    public function flightOfferPrices($flightOffers){
        
        $init = $this->amadeus->getShopping()->getFlightOffers()->getPricing()->postWithFlightOffers($flightOffers);
        
        $result = $init[0]->getResponse()->getBody();
        return $result;
    }

   
}