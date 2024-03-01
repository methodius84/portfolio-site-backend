<?php

namespace App\DTO\Weather\SharedDTO;

use stdClass;

class CityDTO
{
    private readonly int $id;
    private readonly string $name;
    private readonly stdClass $coordinates;
    private readonly string $country;
    private readonly int $population;
    private readonly int $timezone;
    private readonly int $sunrise;
    private readonly int $sunset;

    public function __construct(object $city)
    {
        $this->id = $city->id;
        $this->name = $city->name;
        $this->coordinates = $city->coord;
        $this->country = $city->country;
        $this->population = $city->population;
        $this->timezone = $city->timezone;
        $this->sunrise = $city->sunrise;
        $this->sunset = $city->sunset;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCoordinates(): stdClass
    {
        return $this->coordinates;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getPopulation(): int
    {
        return $this->population;
    }

    public function getTimezone(): int
    {
        return $this->timezone;
    }

    public function getSunrise(): int
    {
        return $this->sunrise;
    }

    public function getSunset(): int
    {
        return $this->sunset;
    }
}
