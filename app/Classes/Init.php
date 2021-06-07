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
    /**
     * The Musement API object.
     *
     * @var object
     */

    private $musement;

    /**
     * The WeatherApi API object.
     *
     * @var object
     */

    private $weatherApi;

    /**
     * The Log object used through the app: default (Monolog)
     *
     * @var object
     */

    private $logger;

    /**
     * The string used as end of line
     *
     * @var string
     */

    private $eol = '<br>';

    public function __construct()
    {
        $this->logger = new Logger('main');
        $this->logger->pushHandler(new StreamHandler(__DIR__ . '/logs/' . date("Y-m-d") . '.log', Logger::DEBUG));

        $this->musement = new Musement();
        $this->weatherApi = new WeatherApi($this->logger);
        $this->setEol();
    }

    /**
     * After retrieved the cities and their forecast
     * return just a string if cli is detected
     * otherwise apply the scaffolding to be used as normal html page
     *
     * @return string
     */

    public function getCityForecast()
    {
        $cities = $this->musement->getCities();
        $forecast_city = [];

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

        // Using the html template if cli is detected
        if (!$this->isCli()) {
            $cities_forecast = str_replace('{cities_forecast}', $cities_forecast, $this->scaffolding());
        }

        return $cities_forecast;
    }

    // Detect if php is running from cli
    private function isCli()
    {
        if (empty($_SERVER['REMOTE_ADDR']) and !isset($_SERVER['HTTP_USER_AGENT']) and count($_SERVER['argv']) > 0) {
            return true;
        }

        return false;
    }

    // If cli is detected set the end of file
    private function setEol()
    {
        if ($this->isCli()) {
            $this->eol = PHP_EOL;
        }
    }

    // Html template that wiil be used if the app is called within a browser
    private function scaffolding()
    {
        return <<<MUC
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jagaad Test</title>
</head>

<body>
    {cities_forecast}
</body>

</html>
MUC;
    }
}
