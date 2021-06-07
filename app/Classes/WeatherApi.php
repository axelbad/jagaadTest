<?php

namespace App\Classes;

use Curl\Curl;
use Exception;
use App\Interfaces\WeatherInterface;

class WeatherApi implements WeatherInterface
{
    public $city;
    private $logger;

    public function __construct($logger)
    {
        $this->logger = $logger;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function getWeather()
    {
        $curl = new Curl();

        $curl->get('https://api.weatherapi.com/v1/forecast.json', [
            'key' => '9fcea37f94344f0cb60151254210206',
            'q' => urlencode($this->city),
            'days' => 2,
            'aqi' => 'no',
            'alerts' => 'no',
            'hour' => 12,
        ]);

        $response = $curl->response;

        // If a key error exists it means that something wrong is happened while retriving the forecat
        // ie: wrong key, city not found.
        // In that case error is logged.
        if ((!key_exists('error', $response)) && ($curl->getHttpStatusCode() == 200)) {
            return $response;
        } else {
            $this->logger->info('Forecast not found for city: ' . $this->city);
            $this->logger->info('Error Code: ' . $response->error->code);
            $this->logger->info('Error Name: ' . $response->error->message);
        }

        return [];
    }
}
