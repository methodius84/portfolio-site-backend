<?php

namespace App\Http\Controllers\Weather;

use App\Http\Controllers\Controller;
use App\Http\Resources\CityCollection;
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

    public function search(Request $request): CityCollection | JsonResponse
    {
        return new CityCollection(
            City::query()->where('name', 'ILIKE', "%" . $request->get('query') . "%")
                ->orWhere('name_ru', 'ILIKE', "%" . $request->get('query') . "%")
                ->get()
        );
    }
}
