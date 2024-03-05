<?php

namespace App\DTO\Weather\SharedDTO;

class WindDTO
{
    private float $speed;
    private int $degree;
    private ?float $gust;

    public function __construct(object $wind)
    {
        $this->speed = $wind->speed;
        $this->degree = $wind->deg;
        $this->gust = $wind->gust ?? null;
    }

    /**
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * @return integer
     */
    public function getDegree(): int
    {
        return $this->degree;
    }

    /**
     * @return float
     */
    public function getGust(): float
    {
        return $this->gust;
    }

}
