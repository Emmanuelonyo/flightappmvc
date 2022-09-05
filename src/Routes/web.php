<?php
use App\Handler\Web;

/**
 * @var $app
 */

$app->get("/", Web::class. "::index");
