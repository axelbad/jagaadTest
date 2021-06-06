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

    public function getWeather()
    {
        $this->weatherApi->setCity($this->city);
        $this->weather_data = $this->weatherApi->getweather();

        $response = [];

        if (!empty($this->weather_data)) {
            $response['city'] = $this->city;
            $response['today_forecast'] = $this->getForecast($this->weather_data, 0);
            $response['tomorrow_forecast'] = $this->getForecast($this->weather_data, 1);
        }

        return $response;
    }

    public function getForecast($response, $day)
    {
        if (isset($response->forecast->forecastday[$day]->day->condition->text)) {
            return $response->forecast->forecastday[$day]->day->condition->text;
        }

        return "";
    }
}
