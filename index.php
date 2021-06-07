<?php

require __DIR__ . '/vendor/autoload.php';

use App\Classes\Init;

$init = new Init();
$cities_forecast = $init->getCityForecast();

echo $cities_forecast;
