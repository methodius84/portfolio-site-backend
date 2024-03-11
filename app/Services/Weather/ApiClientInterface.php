<?php

namespace App\Services\Weather;

use App\DTO\Weather\QueryDTO\BuildQueryInterface;

interface ApiClientInterface
{
    public function execute(BuildQueryInterface $params);
}
