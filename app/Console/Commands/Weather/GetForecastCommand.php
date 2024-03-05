<?php

namespace App\Console\Commands\Weather;

use App\DTO\Weather\CurrentWeatherDTO;
use App\DTO\Weather\ForecastDTO;
use App\DTO\Weather\QueryParamsDTO;
use App\Models\Weather\City;
use App\Services\Weather\WeatherApiClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetForecastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-forecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new WeatherApiClient();

        $cities = [
            'Moscow' => [
                'lat' => 55.751244,
                'lon' => 37.618423,
            ],
            'New York' => [
                'lat' => 40.730610,
                'lon' => -73.935242
            ],
            'London' => [
                'lat' => 51.509865,
                'lon' => -0.118092
            ],
            'Saint Petersburg' => [
                'lat' => 59.937500,
                'lon' => 30.308611
            ],
            'Paris' => [
                'lat' => 48.864716,
                'lon' => 2.349014
            ],
            'Volgograd' => [
                'lat' => 48.700001,
                'lon' => 44.516666
            ],
        ];

        foreach ($cities as $key => $city) {
            $query = new QueryParamsDTO('weather', $city['lat'], $city['lon']);
            /** @var CurrentWeatherDTO $response */
            $response = $client->execute($query);
            if ($response->getCode() === 200) {
                City::query()->updateOrCreate([
                    'lat' => $city['lat'],
                    'lon' => $city['lon'],
                ], [
                    'name' => $response->getCityName(),
                    'lat' => $city['lat'],
                    'lon' => $city['lon'],
                    'country' => $response->getCountry(),
                    'timezone' => $response->getTimezone(),
                    'sunrise' => $response->getSunrise() + $response->getTimezone(),
                    'sunset' => $response->getSunset() + $response->getTimezone(),
                ]);
            }
        }

        return 0;
    }
}
