<?php

namespace App\Models\Weather;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityCurrentWeather extends WeatherModel
{
    use HasFactory;

    protected $table = 'city_weather';

    protected $guarded = [
        'uuid',
        'created_at',
        'updated_at'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_uuid', 'uuid');
    }
}
