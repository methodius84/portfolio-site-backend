<?php

namespace App\DTO\Weather\QueryDTO\Geocode;

use App\DTO\Weather\QueryDTO\BuildQueryInterface;

abstract class GeocodeQueryDTO implements BuildQueryInterface
{
    public function __construct(protected readonly string $method, protected readonly int $limit = 1) {}

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
