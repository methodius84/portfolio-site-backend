<?php

namespace App\DTO\Weather\ResponseDTO\Geocode;

class LocationDTO
{
    private readonly string $name;
    private readonly \stdClass $localNames;
    private readonly float $lat;
    private readonly float $lon;
    private readonly string $country;

    public function __construct(object $location)
    {
        $this->name = $location->name;
        $this->localNames = $location->local_names;
        $this->lat = $location->lat;
        $this->lon = $location->lon;
        $this->country = $location->country;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalNames(): \stdClass
    {
        return $this->localNames;
    }

    public function getLat(): float
    {
        return $this->lat;
    }

    public function getLon(): float
    {
        return $this->lon;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}
