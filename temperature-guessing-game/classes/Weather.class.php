<?php

class Weather
{
    private $apiKey = "your_api_token";

    public function getCityTemperature($city, $country) {
        $url = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city . "," . $country) . "&appid=" . $this->apiKey . "&units=metric";

        $response = file_get_contents($url); // API-Response ist ein String im json-Format
        if ($response == false) {
            return null;
        }

        $data = json_decode($response, true); //verwandelt json-string in assoziatives array
        return $data['main']['temp']; // der Wert "temp" wird aus main geholt
    }
}