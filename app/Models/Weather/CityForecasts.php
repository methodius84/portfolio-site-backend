<?php

namespace App\Models\Weather;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityForecasts extends WeatherModel
{
    use HasFactory;
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
