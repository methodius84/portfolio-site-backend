<?php

namespace App\DTO\Weather;

use App\DTO\Weather\SharedDTO\WeatherInfoDTO;

class CurrentWeatherDTO
{
    private readonly WeatherInfoDTO $weatherInfo;

    public function __construct(object $response)
    {
        $this->weatherInfo = new WeatherInfoDTO($response);
    }

    /**
     * @return WeatherInfoDTO
     */
    public function getWeatherInfo(): WeatherInfoDTO
    {
        return $this->weatherInfo;
    }

}
