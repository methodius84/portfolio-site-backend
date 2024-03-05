<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WeatherApiException extends Exception
{
    public function render(Request $request): Response
    {
        return response('Error getting data', 400);
    }
}
