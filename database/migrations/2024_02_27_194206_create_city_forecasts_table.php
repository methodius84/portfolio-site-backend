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
        Schema::create('weather.city_forecasts', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->bigInteger('date')->comment('За какое время прогноз');
            $table->decimal('temperature');
            $table->decimal('feels_like');
            $table->decimal('temp_min');
            $table->decimal('temp_max');
            $table->integer('pressure');
            $table->smallInteger('humidity');
            $table->smallInteger('cloudiness')->comment('Облачность, в %');
            $table->decimal('wind_speed');
            $table->integer('wind_degree');
            $table->decimal('wind_gust')->nullable();
            $table->enum('daytime',['d','n'])->comment('Время суток');
            $table->integer('visibility');
            $table->smallInteger('pop')->comment('Вероятность осадков');
            $table->string('weather');
            $table->string('weather_description');
            $table->foreignUuid('city_uuid')->constrained('weather.cities', 'uuid');
            $table->index(['city_uuid', 'date']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather.city_forecasts');
    }
};
