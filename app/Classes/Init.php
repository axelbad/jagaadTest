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
    private $eol = '<br>';

    public function __construct()
    {
        $this->logger = new Logger('main');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/logs/' . date("Y-m-d") . '.log', Logger::DEBUG));

        $this->musement = new Musement();
        $this->weatherApi = new WeatherApi($this->logger);
        $this->setEol();
    }

    public function getCityForecast()
    {
        $cities = $this->musement->getCities();
        $forecast_city = [];
        $i = 0;

        $cities_forecast = "";
        foreach ($cities as $city) {
            $weahter = new Weather($this->weatherApi, $city);
            $wheater_data = $weahter->getWeather();

            if (!empty($wheater_data)) {
                $cities_forecast .= 'Processed city ' . $wheater_data['city'] . ' | ';
                $cities_forecast .= $wheater_data['today_forecast'] . ' - ' . $wheater_data['tomorrow_forecast'];
                $cities_forecast .= $this->eol;
            }
        }

        return $cities_forecast;
    }

    // Detect if php is running from cli
    public function isCli()
    {
        if (empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0) {
            return true;
        }

        return false;
    }

    public function setEol()
    {
        if ($this->isCli()) {
            $this->eol = PHP_EOL;
        }
    }
}
