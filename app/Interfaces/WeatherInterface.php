<?php

namespace App\Interfaces;

interface WeatherInterface
{
    public function setCity(string $city);

    public function getWeather();
}
