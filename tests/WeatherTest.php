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
}
