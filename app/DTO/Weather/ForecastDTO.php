<?php

namespace App\DTO\Weather;

use App\DTO\Weather\SharedDTO\CityDTO;
use App\DTO\Weather\SharedDTO\WeatherInfoDTO;

class ForecastDTO
{
    private readonly string $code;
    private readonly int $count;
    private ?array $weatherInfos;

    private ?CityDTO $city;

    public function __construct(object $response)
    {
        $this->code = $response->cod;
        $this->count = $response->cnt;
        $this->weatherInfos = [];
        foreach ($response->list as $info) {
            $this->weatherInfos[] = new WeatherInfoDTO($info);
        }
        $this->city = $response->city ? new CityDTO($response->city) : null;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return WeatherInfoDTO[]|null
     */
    public function getWeatherInfos(): ?array
    {
        return $this->weatherInfos;
    }

    /**
     * @return CityDTO|null
     */
    public function getCity(): ?CityDTO
    {
        return $this->city;
    }
}
