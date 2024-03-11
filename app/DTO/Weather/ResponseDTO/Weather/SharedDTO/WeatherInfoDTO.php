<?php

namespace App\DTO\Weather\ResponseDTO\Weather\SharedDTO;

class WeatherInfoDTO
{
    private readonly int $timestamp;
    private readonly WeatherParametersDTO $weatherParameters;
    private readonly WeatherDTO $weather;
    private readonly CloudinessDTO $cloudiness;
    private readonly WindDTO $wind;
    private readonly int $visibility;
    private readonly ?float $pop;
    /**
     * @var string|null Part of the day(d | n)
     */
    private readonly ?string $pod;

    public function __construct(object $info)
    {
        $this->timestamp = $info->dt;
        $this->weatherParameters = new WeatherParametersDTO($info->main);
        $this->weather = new WeatherDTO($info->weather[0]);
        $this->cloudiness = new CloudinessDTO($info->clouds);
        $this->wind = new WindDTO($info->wind);
        $this->visibility = $info->visibility;
        $this->pop = $info->pop ?? null;
        $this->pod = $info->sys->pod ?? null;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getWeatherParameters(): WeatherParametersDTO
    {
        return $this->weatherParameters;
    }

    public function getWeather(): WeatherDTO
    {
        return $this->weather;
    }

    public function getCloudiness(): CloudinessDTO
    {
        return $this->cloudiness;
    }

    public function getWind(): WindDTO
    {
        return $this->wind;
    }

    public function getVisibility(): int
    {
        return $this->visibility;
    }

    /**
     * Только для прогнозов погоды
     *
     * Вероятность осадков(от 0 до 1, где 0 это 0%, 1 - 100%)
     * @return float|null
     */
    public function getPop(): ?float
    {
        return $this->pop;
    }

    /**
     * Только для прогнозов погоды
     * @return string|null Part of the day(d | n)
     */
    public function getPod(): ?string
    {
        return $this->pod;
    }

}
