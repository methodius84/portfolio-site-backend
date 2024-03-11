<?php

namespace App\Console\Commands\Weather;

use App\DTO\Weather\QueryDTO\Geocode\DirectGeocodeQueryDTO;
use App\DTO\Weather\QueryDTO\Weather\WeatherQueryDTO;
use App\DTO\Weather\ResponseDTO\Geocode\ResponseDTO;
use App\DTO\Weather\ResponseDTO\Weather\CurrentWeatherDTO;
use App\DTO\Weather\ResponseDTO\Weather\ForecastDTO;
use App\DTO\Weather\ResponseDTO\Weather\SharedDTO\WeatherInfoDTO;
use App\Models\Weather\City;
use App\Models\Weather\CityForecast;
use App\Models\Weather\CityCurrentWeather;
use App\Services\Weather\WeatherApiClient;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

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
            'Moscow,RU',
            'New York,US',
            'London,GB',
            'Saint Petersburg,RU',
            'Paris,FR',
            'Volgograd,RU'
        ];

        foreach ($cities as $city) {
            $query = new DirectGeocodeQueryDTO($city);
            /** @var ResponseDTO $response */
            $response = $client->setClient('geocode')->execute($query);
//            print_r($response);

            $location = $response->getLocations()[0];

            City::query()->updateOrCreate([
                'name' => $location->getLocalNames()->en ?? $location->getName(),
                'country' => $location->getCountry()
            ], [
                'name_ru' => $location->getLocalNames()->ru ?? null,
                'lat' => $location->getLat(),
                'lon' => $location->getLon(),
            ]);

            $model = City::query()->where('lat', $location->getLat())->where('lon', $location->getLon())->first();
            $query = new WeatherQueryDTO('weather', $model->lat, $model->lon);

            /** @var CurrentWeatherDTO $weather */
            $weather = $client->setClient()->execute($query);
            print_r($weather);
            $model->update([
                'timezone' => $weather->getTimezone(),
                'sunrise' => $weather->getSunrise(),
                'sunset' => $weather->getSunset(),
            ]);
            $model->refresh();
            CityCurrentWeather::query()->updateOrCreate([
                'city_uuid' => $model->uuid,
            ], [
                'temperature' => $weather->getWeatherInfo()->getWeatherParameters()->getTemperature(),
                'feels_like' => $weather->getWeatherInfo()->getWeatherParameters()->getFeelsLike(),
                'temp_min' => $weather->getWeatherInfo()->getWeatherParameters()->getTempMin(),
                'temp_max' => $weather->getWeatherInfo()->getWeatherParameters()->getTempMax(),
                'pressure' => $weather->getWeatherInfo()->getWeatherParameters()->getPressure(),
                'humidity' => $weather->getWeatherInfo()->getWeatherParameters()->getHumidity(),
                'cloudiness' => $weather->getWeatherInfo()->getCloudiness()->getCloudiness(),
                'wind_speed' => $weather->getWeatherInfo()->getWind()->getSpeed(),
                'wind_degree' => $weather->getWeatherInfo()->getWind()->getDegree(),
                'wind_gust' => $weather->getWeatherInfo()->getWind()->getGust(),
                'visibility' => $weather->getWeatherInfo()->getVisibility(),
                'weather' => $weather->getWeatherInfo()->getWeather()->getMain(),
                'weather_description' => $weather->getWeatherInfo()->getWeather()->getDescription(),
            ]);

            $query = new WeatherQueryDTO('forecast', $model->lat, $model->lon);
            /** @var ForecastDTO $forecasts */
            $forecasts = $client->execute($query);

            if ($forecasts->getWeatherInfos()) {
                /** @var WeatherInfoDTO $forecast */
                foreach ($forecasts->getWeatherInfos() as $forecast) {
                    CityForecast::query()->updateOrCreate([
                        'city_uuid' => $model->uuid,
                        'date' => $forecast->getTimestamp()
                    ], [
                        'temperature' => $weather->getWeatherInfo()->getWeatherParameters()->getTemperature(),
                        'feels_like' => $weather->getWeatherInfo()->getWeatherParameters()->getFeelsLike(),
                        'temp_min' => $weather->getWeatherInfo()->getWeatherParameters()->getTempMin(),
                        'temp_max' => $weather->getWeatherInfo()->getWeatherParameters()->getTempMax(),
                        'pressure' => $weather->getWeatherInfo()->getWeatherParameters()->getPressure(),
                        'humidity' => $weather->getWeatherInfo()->getWeatherParameters()->getHumidity(),
                        'cloudiness' => $weather->getWeatherInfo()->getCloudiness()->getCloudiness(),
                        'wind_speed' => $weather->getWeatherInfo()->getWind()->getSpeed(),
                        'wind_degree' => $weather->getWeatherInfo()->getWind()->getDegree(),
                        'wind_gust' => $weather->getWeatherInfo()->getWind()->getGust(),
                        'daytime' => $forecast->getPod(),
                        'visibility' => $weather->getWeatherInfo()->getVisibility(),
                        'pop' => $forecast->getPop(),
                        'weather' => $weather->getWeatherInfo()->getWeather()->getMain(),
                        'weather_description' => $weather->getWeatherInfo()->getWeather()->getDescription(),
                    ]);
                }
            }
        }

        return 0;
    }
}
