<?php
declare (strict_types=1);

namespace App\Handler ; 

class Web{

    /**
     * create any views page as a function and require the view file from public_html folder
     * 
     */
    public function index(){
        echo "WELCOME TO THE INDEX";
    }


}