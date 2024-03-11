<?php

namespace App\DTO\Weather\ResponseDTO\Weather\SharedDTO;

class WeatherDTO
{
    private readonly int $id;
    private readonly string $main;
    private readonly string $description;

    public function __construct(object $weather)
    {
        $this->id = $weather->id;
        $this->main = $weather->main;
        $this->description = $weather->description;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMain(): string
    {
        return $this->main;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}
