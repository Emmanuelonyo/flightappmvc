<?php
declare (strict_types=1);
namespace App\Handler; 
use App\Controller\{
    FlightController,
    Controller
};

class Web{

    /**
     * create any views page as a function and require the view file from public_html folder
     * 
     */
    public function index(){
        require __DIR__ . "/../../public_html/views/index.php";
    }
    
    public function flights(){
        $title = "Flight Result";

        //search for flight offers 
        if(!isset($_POST) || empty($_POST)){
            header("Location: /");
        }

        //set the payloads to get flight offer  
        $flightFrom  = explode("-", $_POST['flightFrom']);
        $flightTo = explode("-", $_POST['flightTo']);
        $ddate = explode("-",$_POST['flightDepart']);
        $ddate = $ddate[2]."-".$ddate[0]."-".$ddate[1] ;
        $payload = [
            "originLocationCode"=> trim($flightFrom[1]),
            "destinationLocationCode" => trim($flightTo[1]),
            "departureDate" => trim($ddate),
            "adults"=> trim($_POST['flightAdult-travellers']),
            "children"=> trim($_POST['flightChildren-travellers']),
            "max"=> 2
        ];

        // GET FLIGHT OFFERS
        $getflightsOffer = (new FlightController)->flightOfferPrices($payload);
       
        $data = (json_decode($getflightsOffer))->data;
        

        require __DIR__ . "/../../public_html/views/flight-details.php";
    }

    public function confirm(){
        require __DIR__ . "/../../public_html/views/flight-confirm.php";
    }
    
    public function hotels(){
        require __DIR__ . "/../../public_html/views/hotels-list.php";
    }

    public function hotel_book(){
        require __DIR__ . "/../../public_html/views/hotel-booking.php";
    }

    public function book(){
        require __DIR__ . "/../../public_html/views/payment";
    }
   
}   