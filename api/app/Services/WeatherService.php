<?php

namespace App\Services;

use GuzzleHttp\Client;

class WeatherService {

    public function weatherInfo($lat, $long){

        try {
            $base_url = config('services.weather.url');
            $key = config('services.weather.key');
            $url = $base_url."?lat=".$lat."&lon=".$long."&exclude=hourly,daily&appid=".$key;
    
            $client = new Client();
    
            $request = $client->get($url);
    
            $response = $request->getBody();

            return json_decode($response, true);

        } catch (\Throwable $th) {
            throw new \Exception("Something went wrong", 500);
            
        }


    }
}