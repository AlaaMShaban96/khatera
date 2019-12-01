<?php

namespace App\Http\Controllers\Api;


use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FollowerResources;
use App\Http\Resources\FollowingsResource;
use App\Http\Resources\UsersWithPostsResource;

class FollowerController extends Controller
{
   /**
 * Follow the user.
 *
 * @param $profileId
 *
 */ 
    public function followUser(User $user)
    { 
        if(! $user) {
            
            return response()->json(['error'=> 'User does not exist.'],400);
        }

        $user->followers()->attach(auth()->user()->id);

        return response()->json(['success'=> 'Successfully followed the user.'],200);
    }
    
/**
 * Follow the user.
 *
 * @param $profileId
 *
 */
    public function unFollowUser(User $user)
    {
        if(! $user) {
            
            return response()->json(['error'=> 'User does not exist.'],400);
        }
        $user->followers()->detach(auth()->user()->id);
        return response()->json(['success'=> 'Successfully unFollow the user.'],200);    
    }

    
    public function followers()
    {  
      return (new FollowerResources(auth()->user()))->response()->setStatusCode(200);

    }
    
    public function followings()
    {
        return (new FollowingsResource(auth()->user()))->response()->setStatusCode(200);
    }
    public function followingsPost()
    {
        return (new UsersWithPostsResource(auth()->user()->followings))->response()->setStatusCode(200);
    }
    
}