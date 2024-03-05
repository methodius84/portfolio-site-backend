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
            $table->enum('type', ['now', 'forecast']);
            $table->timestamp('date')->comment('За какое время прогноз');
            $table->decimal('temperature');
            $table->decimal('feels_like');
            $table->decimal('temp_min');
            $table->decimal('temp_max');
            $table->integer('pressure');
            $table->integer('humidity');
            $table->integer('cloudiness');
            $table->decimal('wind_speed');
            $table->integer('wind_degree');
            $table->decimal('wind_gust')->nullable();
            $table->enum('daytime',['d','n']);
            $table->integer('visibility');
            $table->smallInteger('pop')->nullable()->comment('Вероятность осадков');
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
