<?php

namespace App\Models\Weather;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends WeatherModel
{
    use HasFactory;
    protected $table = 'cities';
    protected $fillable = [
        'name',
        'lat',
        'lon',
    ];
}
