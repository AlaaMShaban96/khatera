<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostsResource;
use App\Http\Resources\SearchByNameResource;
use App\Http\Resources\UsersWithPostsResource;

class UserController extends Controller
{
    public function searchByName(Request $request)
    {
       // dd($request->name);
         // orWhere('name','LIKE','%'.$query.'%')->
        $users = User::Where('name','LIKE','%'.$request->name.'%')->get();
        // $users = User::where('titel','LIKE','%'.$query.'%')->get();;SearchByNameResource
        return (SearchByNameResource::collection( $users))->response()->setStatusCode(200);   
     }
     public function show(User $user)
     {
        
        return (new PostsResource( $user->posts->paginate()))->response()->setStatusCode(200);   

     }
}
