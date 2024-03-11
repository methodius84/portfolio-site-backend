<?php

namespace App\DTO\Weather\QueryDTO;

interface BuildQueryInterface
{
    public function buildQuery(): string;
}
