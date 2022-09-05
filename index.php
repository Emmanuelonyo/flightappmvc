<?php
require __DIR__ . "/src/config.php";
use App\Router;

$app = new Router();


// ROUTES FOR APP AND WEB USERS 

require __DIR__ . "/src/Routes/web.php";

require __DIR__ . "/src/Routes/api.php";


$app->makeNotfoundHandler(function(){
    echo "PAGE NOT FOUND";
});

$app->run();