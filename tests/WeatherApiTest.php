<?php

namespace test\WeatherApiTest;

use Monolog\Logger;
use App\Classes\WeatherApi;
use PHPUnit\Framework\TestCase as TestCase;

class WeatherApiTest extends TestCase
{
    protected static $weatherApi;

    public static function setUpBeforeClass(): void
    {
        $logger = new Logger('test');
        self::$weatherApi = new WeatherApi($logger);
    }

    public function testNewInstance()
    {
        $this->assertInstanceOf('App\Classes\WeatherApi', self::$weatherApi);
    }

    public function testGetWeatherWithRealCity()
    {
        self::$weatherApi->setCity('Palermo');

        $this->assertIsObject(self::$weatherApi->getWeather('Palermo'));
    }

    public function testGetWeatherWithFakeCity()
    {
        self::$weatherApi->setCity('adsasdad');

        $resp = self::$weatherApi->getWeather();

        $this->assertEmpty($resp);
    }

    public function testGetWeatherWithEmptyCity()
    {
        self::$weatherApi->setCity('');

        $resp = self::$weatherApi->getWeather('');

        $this->assertEmpty($resp);
    }
}
