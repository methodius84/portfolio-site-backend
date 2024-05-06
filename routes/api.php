<?php

use App\Http\Controllers\Weather\ApiController;
use App\Http\Resources\CityCollection;
use App\Models\Weather\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function () {
    Route::prefix('weather')->group(function () {
        Route::get('cities', function () {
            return new CityCollection(City::all());
        })->name('cities');
        Route::get('forecast/{id}', [ApiController::class, 'getWeather'])->name('forecast');
        Route::get('search', [ApiController::class, 'search'])->name('search');
    });
});
