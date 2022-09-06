<?php
declare(strict_types=1);
namespace App\Controller;
use Amadeus\Amadeus;
use Amadeus\Exceptions\ResponseException;

class FlightController extends Controller{

    public function __construct(){
        // $this->__setHeaders();
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
            $result = json_decode($result,true);
             print_r($result);
            foreach($result as $key => $value){
                // print_r($value);
                $value['flightOffers']["validatingAirlineCodes"]['AirlineName'] = $this->getAirline(["airlineCodes"=>$value['flightOffers']['validatingAirlineCodes'][0]]);
                $values[] = $value;
                
            }

             
            return json_encode($values);

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

    public function getAirline($payload){
        try {

            $init = $this->amadeus->getReferenceData()->getAirlines()->get($payload);
            $result = $init[0]->getResponse()->getBody();    
            // print_r((json_decode($result))->data[0]->businessName)  ;   
           return (json_decode($result))->data[0]->businessName;


        } catch (ResponseException $th) {
            print ($th->getMessage());
        }
    }
   
}