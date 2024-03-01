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
        Schema::create('weather.cities', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name')->unique();
            $table->double('lat', 2, 7);
            $table->double('lon', 3, 7);
            $table->string('country')->nullable();
            $table->bigInteger('population')->nullable();
            $table->integer('timezone')->nullable()->comment('Сдвиг в секундах');
            $table->timestamp('sunrise')->nullable();
            $table->timestamp('sunset')->nullable();
            $table->index(['lat', 'lon']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather.cities');
    }
};
