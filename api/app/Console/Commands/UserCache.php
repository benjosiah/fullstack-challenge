<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Redis;
use App\Models\User;

class UserCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache user  Information';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $users = User::all();

        foreach($users as  $user){
            $weatherService = new WeatherService();
            $weather =  (object) $weatherService->weatherInfo($user->latitude, $user->longitude);
            $user->weather = $weather;
            Redis::set('user_' . $user->id, $user);

            $this->info("user with id ". $user->id. " cached");

        }
    
    }
}
