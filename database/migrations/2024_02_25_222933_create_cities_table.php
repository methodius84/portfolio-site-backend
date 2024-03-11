<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE SCHEMA IF NOT EXISTS weather;");
        Schema::create('weather.cities', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->string('name');
            $table->string('name_ru')->nullable();
            $table->float('lat', 8, 6);
            $table->float('lon', 9, 6);
            $table->string('country');
            $table->integer('timezone')->nullable()->comment('Сдвиг в секундах');
            $table->timestamp('sunrise')->nullable();
            $table->timestamp('sunset')->nullable();
            $table->index(['lon', 'lat']);
            $table->unique(['name', 'country']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weather.cities');
        DB::statement("DROP SCHEMA IF EXISTS weather;");
    }
};
