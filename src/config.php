<?php
require __DIR__ . "/../vendor/autoload.php";

//load dot env

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. "/../");
$dotenv->load();