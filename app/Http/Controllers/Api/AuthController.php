<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    public function register(Request $request)
    { 
         $validatedData = $request->validate([
             'name'=>'required',
             'email'=>'email|required',
             'password'=>'required'
         ]); 
        
         $validatedData['password'] = bcrypt($request->password);
       
         $user = User::create($validatedData);
        
         return response(new UserResource( $user), 200);
       
    
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
       
        return response(new UserResource( auth()->user()), 200);
    }
}
