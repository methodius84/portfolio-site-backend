<?php

namespace App\Http\Controllers\Weather;

use App\Http\Controllers\Controller;
use App\Models\Weather\City;
use App\Models\Weather\CityCurrentWeather;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getWeather(string $uuid): JsonResponse
    {
        $city = City::query()->find($uuid);
        return new JsonResponse([
            'data' => [
                'Forecast' => $city->currentWeather ?? null
            ],
        ]);
    }

}
