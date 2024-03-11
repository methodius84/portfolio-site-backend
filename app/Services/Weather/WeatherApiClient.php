<?php

namespace App\Services\Weather;

use App\DTO\Weather\QueryDTO\BuildQueryInterface;
use App\DTO\Weather\QueryDTO\Geocode\DirectGeocodeQueryDTO;
use App\DTO\Weather\QueryDTO\Geocode\ReverseGeocodeQueryDTO;
use App\DTO\Weather\ResponseDTO\Geocode\ResponseDTO;
use App\DTO\Weather\ResponseDTO\Weather\CurrentWeatherDTO;
use App\DTO\Weather\ResponseDTO\Weather\ForecastDTO;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WeatherApiClient implements ApiClientInterface
{
    private const WEATHER = 'weather';
    private const GEOCODE = 'geocode';
    private ?Client $client = null;

    public function execute(BuildQueryInterface $params)
    {
        $query = $params->buildQuery();
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
            //TODO Geocode DTO
            'direct', 'reverse' => new ResponseDTO($data),
        };
    }

    public function setClient(string $type = 'weather'): self
    {
        $base_uri = match ($type) {
            self::GEOCODE => config('services.open_weather_map.base_geocode_uri'),
            default => config('services.open_weather_map.base_uri'),
        };
        $this->client = new Client([
            'base_uri' => $base_uri,
            'verify' => false
        ]);
        return $this;
    }
}
