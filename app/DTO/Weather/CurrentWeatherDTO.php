<?php

namespace App\DTO\Weather;

use App\DTO\Weather\SharedDTO\WeatherInfoDTO;
use stdClass;

class CurrentWeatherDTO
{
    private readonly int $code;
    private readonly stdClass $coordinates;
    private readonly int $timestamp;
    private readonly ?int $timezone;
    private readonly ?string $cityName;
    private readonly ?string $country;
    private readonly ?int $sunrise;
    private readonly ?int $sunset;
    private readonly WeatherInfoDTO $weatherInfo;

    public function __construct(object $response)
    {
        $this->code = $response->cod;
        $this->coordinates = $response->coord;
        $this->timestamp = $response->dt;
        $this->timezone = $response->timezone ?? null;
        $this->cityName = $response->name ?? null;
        $this->country = $response->sys->country ?? null;
        $this->sunrise = $response->sys->sunrise ?? null;
        $this->sunset = $response->sys->sunset ?? null;
        $this->weatherInfo = new WeatherInfoDTO($response);
    }

    /**
     * @return WeatherInfoDTO
     */
    public function getWeatherInfo(): WeatherInfoDTO
    {
        return $this->weatherInfo;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getCoordinates(): stdClass
    {
        return $this->coordinates;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getTimezone(): ?int
    {
        return $this->timezone;
    }

    public function getCityName(): ?string
    {
        return $this->cityName;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function getSunrise(): ?int
    {
        return $this->sunrise;
    }

    public function getSunset(): ?int
    {
        return $this->sunset;
    }

}
