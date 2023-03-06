<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\WeatherService;

class WeatherTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_weather_endpoint_latitude_and_longitude_is()
    {
        $weather = new WeatherService();
        $result = $weather->weatherInfo("-15", "-86.78955500");
        // dd($result);
        $this->assertTrue(array_key_exists('current', $result));
    }

    public function test_weather_endpoint_return_current_data()
    {
        $weather = new WeatherService();
        $result = $weather->weatherInfo("-15", "-86.78955500");
        // dd($result);
        $this->assertTrue(array_key_exists('current', $result));
    }
}
