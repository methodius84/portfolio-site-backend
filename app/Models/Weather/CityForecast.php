<?php

namespace App\Models\Weather;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityForecast extends WeatherModel
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

    protected function pop(): Attribute
    {
        return Attribute::make(
            set: fn(float $value) => (int) ($value * 100)
        );
    }
}
