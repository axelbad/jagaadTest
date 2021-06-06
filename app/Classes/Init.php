<?php

namespace App\Classes;

use App\Classes\Weather;
use App\Classes\Musement;
use App\Classes\WeatherApi;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Jagaad Test - Init Function
 *
 * @author    Alessandro Badiglio <axelba@gmail.com>
 */
class Init
{
    private $musement;
    private $weatherApi;
    private $logger;

    public function __construct()
    {
        $this->logger = new Logger('main');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/logs/' . date("Y-m-d") . '.log', Logger::DEBUG));

        $this->musement = new Musement();
        $this->weatherApi = new WeatherApi($this->logger);
    }

    public function getCityForecast()
    {
        $cities = $this->musement->getCities();
        $forecast_city = [];
        $i = 0;

        foreach ($cities as $city) {
            $weahter = new Weather($this->weatherApi, $city);
            $wheater_data = $weahter->getWeather();

            if (!empty($wheater_data)) {
                $forecast_city[$i]['city'] = $wheater_data['city'];
                $forecast_city[$i]['today_forecast'] = $wheater_data['today_forecast'];
                $forecast_city[$i]['tomorrow_forecast'] = $wheater_data['tomorrow_forecast'];

                $i++;
            }
        }

        return $forecast_city;
    }
}
