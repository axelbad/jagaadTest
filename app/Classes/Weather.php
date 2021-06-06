<?php

namespace App\Classes;

use App\Classes\WeatherApi;

class Weather
{
    private $weather_data;
    private $weatherApi;
    private $city;

    public function __construct(WeatherApi $weatherApi, string $city)
    {
        $this->weatherApi = $weatherApi;
        $this->city = $city;
    }
}
