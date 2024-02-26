<?php

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
            return new \Illuminate\Http\JsonResponse([
                'Cities' => [
                    ['id' => 1, 'name' => 'Moscow'],
                    ['id' => 2, 'name' => 'Saint-Petersburg'],
                    ['id' => 3, 'name' => 'Volgograd'],
                    ['id' => 4, 'name' => 'Novosibirsk'],
                ]
            ], 200);
        })->name('cities');
    });
});
