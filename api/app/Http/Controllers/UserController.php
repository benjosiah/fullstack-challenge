<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function index(){
        try {
            $users = $this->user->getUsers();
            return response()->json([
                'users' => $users,
                'status' => 'success'
            ], 200);
        } catch (\Throwable $th) {
            $code = (strlen((string)$th->getCode()) < 3) ? 500 : $th->getCode();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 'failed'
            ], $code);
        }
        
    }

    public function show($id){
        try {
            $user = $this->user->usersWeather($id);
            return response()->json([
                'user' => $user,
                'status' => 'success'
            ], 200);
        } catch (\Throwable $th) {
            $code = (strlen((string)$th->getCode()) < 3) ? 500 : $th->getCode();
            return response()->json([
                'message' => $th->getMessage(),
                'status' => 'failed'
            ], $code);
        }
        
    }
}
