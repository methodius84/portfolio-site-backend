<?php

namespace App\Services\Weather;

use App\DTO\Weather\QueryParamsDTO;

interface ApiClientInterface
{
    public function execute(QueryParamsDTO $params);
}
