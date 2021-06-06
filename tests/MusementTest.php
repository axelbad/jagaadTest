<?php

namespace test\MusementTest;

use App\Classes\Musement;
use PHPUnit\Framework\TestCase as TestCase;

class MusementTest extends TestCase
{
    public function testNewInstance()
    {
        $mus = new Musement();

        $this->assertInstanceOf('App\Classes\Musement', $mus);
    }

    public function testGetCity()
    {
        $mus = new Musement();
        $city = $mus->getCities();

        $this->assertIsArray($city);
    }
}
