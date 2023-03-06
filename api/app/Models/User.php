<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Services\WeatherService;
use Illuminate\Support\Facades\Redis;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getUsers(){
        $users = $this->all();
        
        return $users;
    }

    public function usersWeather($id){
        
        $cachedUser = Redis::get('user_' . $id);
        if(isset($cachedUser)) {
            $user = json_decode($cachedUser, FALSE);
            $now = now();
            $nowInSec = strtotime($now);
            $interval=  ($nowInSec - $user->weather->current->dt)/3600;
            if ($interval > 1) {
                $user = $this->cacheUser($id);
            }

        }else{
          $user = $this->cacheUser($id);
        }
       

        return $user;
    }

    public function cacheUser($id){
        $user = $this->select(['name', 'email', 'latitude', 'longitude'])->where('id', $id)->first();
        if ($user == null) {
            throw new \Exception("User does not exist", 401);
        }
        $weatherService = new WeatherService();
        $weather =  (object) $weatherService->weatherInfo($user->latitude, $user->longitude);
        $user->weather = $weather;
        Redis::set('user_' . $id, $user);

        return $user;
    }
}
