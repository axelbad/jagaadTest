<?php

namespace test\WeatherTest;

use Monolog\Logger;
use App\Classes\Weather;
use App\Classes\WeatherApi;
use PHPUnit\Framework\TestCase as TestCase;

class WeatherTest extends TestCase
{
    protected static $weatherApi;

    public static function setUpBeforeClass(): void
    {
        $logger = new Logger('test');
        self::$weatherApi = new WeatherApi($logger);
    }

    public function testNewInstance()
    {
        $weather = new Weather(self::$weatherApi, 'Palermo');

        $this->assertInstanceOf('App\Classes\Weather', $weather);
    }

    public function testGetWeatherWithRealCity()
    {
        $weather = new Weather(self::$weatherApi, 'Palermo');

        $this->assertIsArray($weather->getWeather('Palermo'));
    }

    public function testGetWeatherWithFakeCity()
    {
        $weather = new Weather(self::$weatherApi, 'asasdadd');

        $resp = $weather->getWeather();

        $this->assertEmpty($resp);
    }

    public function testGetWeatherWithEmptyCity()
    {
        $weather = new Weather(self::$weatherApi, '');

        $resp = $weather->getWeather('');

        $this->assertEmpty($resp);
    }

    public function testgetForecastWithRealCity()
    {
        $weather = new Weather(self::$weatherApi, 'Palermo');
        $resp = $weather->getWeather();

        $today_forecast = $weather->getForecast($resp, 0);
        $this->assertIsString('string', $today_forecast);

        $tomorrow_forecast = $weather->getForecast($resp, 1);
        $this->assertIsString('string', $tomorrow_forecast);
    }

    public function testgetForecastWithFakeCity()
    {
        $weather = new Weather(self::$weatherApi, 'asasdadd');
        $resp = $weather->getWeather();

        $today_forecast = $weather->getForecast($resp, 0);
        $this->assertEmpty($today_forecast);

        $tomorrow_forecast = $weather->getForecast($resp, 1);
        $this->assertEmpty($tomorrow_forecast);
    }
}
