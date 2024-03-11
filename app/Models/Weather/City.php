<?php

namespace App\Models\Weather;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class City extends WeatherModel
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = [
        'name',
        'name_ru',
        'lat',
        'lon',
        'country',
        'timezone',
        'sunrise',
        'sunset',
    ];

    protected $casts = [
        'sunrise' => 'datetime',
        'sunset' => 'datetime',
    ];

    public function forecasts(): HasMany
    {
        return $this->hasMany(CityForecast::class, 'city_uuid', 'uuid');
    }

    public function currentWeather(): HasOne
    {
        return $this->hasOne(CityCurrentWeather::class, 'city_uuid', 'uuid');
    }
}
