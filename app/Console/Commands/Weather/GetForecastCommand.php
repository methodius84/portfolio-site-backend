<?php

namespace App\Console\Commands\Weather;

use App\DTO\Weather\QueryParamsDTO;
use App\Services\Weather\WeatherApiClient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class GetForecastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-forecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $client = new WeatherApiClient();
        $query = new QueryParamsDTO('forecast', '55.751244', 37.618423);


        $data = $client->execute($query);
        echo serialize($data);
        return 0;
    }
}
