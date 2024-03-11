<?php

namespace App\DTO\Weather\QueryDTO\Weather;

use App\DTO\Weather\QueryDTO\BuildQueryInterface;

class WeatherQueryDTO implements BuildQueryInterface
{
    private readonly string $method;
    private readonly float $lat;
    private readonly float $lon;
    private readonly string $units;

    public function __construct(string $method, float $lat, float $lon, $units = null)
    {
        $this->method = $method;
        $this->lat = $lat;
        $this->lon = $lon;
        $this->units = $units ?: config('services.open_weather_map.units');
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function getUnits(): string
    {
        return $this->units;
    }

    public function buildQuery(): string
    {
        return $this->method . '?lat=' . $this->lat . '&lon=' . $this->lon . '&units=' . $this->units;
    }
}
