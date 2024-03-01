<?php

namespace App\Models\Weather;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CityForecasts extends WeatherModel
{
    use HasFactory;
    protected $guarded = [
        'uuid',
        'created_at',
        'updated_at'
    ];
}
