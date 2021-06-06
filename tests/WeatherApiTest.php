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
}
