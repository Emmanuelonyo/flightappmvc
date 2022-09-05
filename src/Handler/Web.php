<?php
declare (strict_types=1);
namespace App\Handler; 

class Web{

    /**
     * create any views page as a function and require the view file from public_html folder
     * 
     */
    public function index(){
        require __DIR__ . "/../../public_html/views/index.php";
    }
    
    public function flights(){
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