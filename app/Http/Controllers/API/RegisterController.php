<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RegisterController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user(); 

            $success['token'] = $user->createToken('token')->plainTextToken; 
            $success['name'] = $user->name;

            return response()->json($success);
        } else { 
            return response()->json('error', 403);
        }
    }
}