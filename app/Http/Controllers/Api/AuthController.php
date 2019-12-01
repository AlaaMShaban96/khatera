<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    { 
         $validatedData = $request->validate([
             'name'=>'required',
             'email'=>'required|email|max:255|unique:users',
             'password'=>'required'
         ]); 
        
         $validatedData['password'] = bcrypt($request->password);
       
         $user = User::firstOrCreate($validatedData);
         return (new UserResource( $user))->response()->setStatusCode(200);
       
    
    }

    public function login(Request $request)
    {
         $loginData = $request->validate([
             'email' => 'email|required',
             'password' => 'required'
         ]);
        
         if(!auth()->attempt($loginData)) {
             return response(['message'=>'Invalid credentials']);
         }
       
        return (new UserResource( auth()->user()))->response()->setStatusCode(200);
    }
    public function logout()
    { 
        if (auth()->check()) {
            auth()->user()->AauthAcessToken()->delete();
            return response(['message'=>'logout successful '],200);
        }
        return response(['message'=>'logout fault']);
        

    }
}
