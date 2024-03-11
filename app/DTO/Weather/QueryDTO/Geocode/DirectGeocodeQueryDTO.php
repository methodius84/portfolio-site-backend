<?php

namespace App\DTO\Weather\QueryDTO\Geocode;

final class DirectGeocodeQueryDTO extends GeocodeQueryDTO
{
    public function __construct(private readonly string $query, ?int $limit = 1)
    {
        parent::__construct('direct', $limit);
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function buildQuery(): string
    {
        return $this->method . '?q=' . $this->query . '&limit=' . $this->limit;
    }
}
