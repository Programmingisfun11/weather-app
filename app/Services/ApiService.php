<?php
namespace App\Services;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class ApiService
{

    public function __construct(Request $request)
    {
        $this->api_key = $request->attributes->get('api_key');
    }

    public function getCityByName($city)
    {
        $url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$this->api_key";
        $object = $this->fetchApi($url);

        if (isset($object['name'])) {
            return $this->getCityLocation($object);
        } else {
            return $object;
        }

    }

    public function fetchApi($url)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get($url);

            if ($request->getStatusCode() == 200) {
                $json = $request->getBody();
                return $object = json_decode($json, true);
            }
        } 
        catch (RequestException $e) {
            $responseBodyAsString = $e->getResponse()->getBody()->getContents();
            $exception = json_decode($responseBodyAsString, true);
            return $exception;
        }

    }

    

    public function getCityLocation($object)
    {
        $location = array(
            'lon' => $object['coord']['lon'],
            'lat' => $object['coord']['lat'],
        );

        return $this->showWeather($location);

    }

    public function showWeather($location)
    {
        $newUrl = "https://api.openweathermap.org/data/2.5/onecall?lat={$location['lat']}&lon={$location['lon']}&exclude=hourly,minutely,alerts,current&units=metric&appid=$this->api_key";

        $object = $this->fetchApi($newUrl);
        $cityName = explode("/", $object['timezone']);
        $daysOfWeek= array('Monday', 'Tuesday', 'Wednesday','Thursday','Friday', 'Saturday','Sunday');

        $weatherData = array(
            'data' => $object['daily'],
            'index' => count($object['daily'])-1,
            'city' => $cityName[1],
            'days'=>$daysOfWeek,
        );
        return $weatherData;
    }
}