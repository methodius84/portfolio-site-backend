<?php

namespace App\DTO\Weather\QueryDTO\Geocode;

final class ReverseGeocodeQueryDTO extends GeocodeQueryDTO
{
    public function __construct(string $method, private readonly float $lat, private readonly float $lon, ?int $limit)
    {
        parent::__construct($method, $limit);
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function buildQuery(): string
    {
        return $this->method . '?lat=' . $this->lat . '&lon=' . $this->lon . '&limit=' . $this->limit;
    }
}
