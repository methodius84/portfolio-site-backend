<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('weather.city_weather', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->decimal('temperature');
            $table->decimal('feels_like')->comment('Ощущается как');
            $table->decimal('temp_min');
            $table->decimal('temp_max');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('cloudiness')->comment('Облачность, в %');
            $table->decimal('wind_speed');
            $table->integer('wind_degree');
            $table->decimal('wind_gust')->nullable()->comment('Порыв ветра.');
            $table->integer('visibility');
            $table->string('weather')->comment('Описание погоды. Главное');
            $table->string('weather_description')->comment('Погода текстом подробнее');
            $table->foreignUuid('city_uuid')->constrained('weather.cities', 'uuid');
            $table->unique('city_uuid');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather.city_weather');
    }
};
