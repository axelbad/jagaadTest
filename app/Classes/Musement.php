<?php

namespace app\Classes;

use Curl\Curl;
use Exception;

class Musement
{
    private $cities;
    private $cities_name = [];

    public function getCities()
    {
        $curl = new Curl();

        try {
            $curl->get('https://sandbox.musement.com/api/v3/cities');

            $response = $curl->response;

            if ((!key_exists('code', $response)) && ($curl->getHttpStatusCode() == 200)) {
                $this->cities = $curl->response;

                foreach ($this->cities as $city) {
                    $this->cities_name[] = $city->name;
                }
            }

            return $this->cities_name;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
