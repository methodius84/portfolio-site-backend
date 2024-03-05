<?php

namespace App\Services\Weather;

use App\DTO\Weather\CurrentWeatherDTO;
use App\DTO\Weather\ForecastDTO;
use App\DTO\Weather\QueryParamsDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\matches;

class WeatherApiClient implements ApiClientInterface
{
    private Client $client;
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.open_weather_map.base_uri'),
            'verify' => false
        ]);
    }

    public function execute(QueryParamsDTO $params)
    {
        $query = $params->formQuery();
        $query .= '&appid=' . config('services.open_weather_map.key');
        try {
            $response = $this->client->get($query);
        } catch (GuzzleException $e) {
            return $e->getMessage();
        }
        $data = $response->getBody()->getContents();
        $data = json_decode($data);
        return match($params->getMethod()) {
            'forecast' => new ForecastDTO($data),
            'weather' => new CurrentWeatherDTO($data),
        };
    }
}
