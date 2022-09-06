<?php
use App\Handler\Web;

/**
 * @var $app
 */

$app->get("/", Web::class. "::index");
$app->get("/flight-details", Web::class. "::flights");
$app->post("/flight-details", Web::class. "::flights");
$app->get("/flight-confirm", Web::class. "::confirm");
$app->get("/hotel-list", Web::class. "::hotels");
$app->get("/hotel-booking", Web::class. "::hotel_book");
$app->get("/payment", Web::class. "::book");