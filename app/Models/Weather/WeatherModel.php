<?php

namespace App\Models\Weather;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeatherModel extends Model
{
    use HasFactory;

    protected $connection = 'weather';
}
