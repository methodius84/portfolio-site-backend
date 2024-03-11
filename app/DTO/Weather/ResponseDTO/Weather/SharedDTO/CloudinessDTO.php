<?php

namespace App\DTO\Weather\ResponseDTO\Weather\SharedDTO;

class CloudinessDTO
{
    private readonly int $cloudiness;
    public function __construct(object $clouds)
    {
        $this->cloudiness = $clouds->all;
    }

    /**
     * @return int
     */
    public function getCloudiness(): int
    {
        return $this->cloudiness;
    }
}
