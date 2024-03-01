<?php

namespace App\DTO\Weather\SharedDTO;

class WeatherParametersDTO
{
    private readonly float $temperature;
    private readonly float $feelsLike;
    private readonly float $tempMin;
    private readonly float $tempMax;
    private readonly int $pressure;
    private readonly int $humidity;

    public function __construct(object $main)
    {
        $this->temperature = $main->temp;
        $this->feelsLike = $main->feels_like;
        $this->tempMin = $main->temp_min;
        $this->tempMax = $main->temp_max;
        $this->pressure = $main->pressure;
        $this->humidity = $main->humidity;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function getFeelsLike(): float
    {
        return $this->feelsLike;
    }

    public function getTempMin(): float
    {
        return $this->tempMin;
    }

    public function getTempMax(): float
    {
        return $this->tempMax;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

}
