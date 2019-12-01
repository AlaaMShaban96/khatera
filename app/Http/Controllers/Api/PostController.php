<?php

namespace App\Http\Controllers\Api;

use App\Post;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostLinkResources;
use App\Exceptions\AppCustomException;

class PostController extends Controller
{
    public function store(Request $request)
    {


        $data = $request->validate([
            'titel' => 'required',
            'image' => 'required',
            'content' => 'required',
            'period' => 'required|numeric|min:0|not_in:0',
        ]);
        $post = Post::firstOrCreate([
            'titel'     => $data['titel'] ,
            'image' => $data['image'] ,
            'content' => $data['content'] ,
        ]);
        $post->CheckYourPost($request->period);
        return (new PostLinkResources($post))->response()->setStatusCode(200);
    }

    
    public function upload_store(Request $request)
    {


        $data = $request->validate([
            'titel' => 'required',
            'image' => 'required',
            'content' => 'required',
            'period' => 'required|numeric|min:0|not_in:0',
        ]);
       
        
        $post = Post::firstOrCreate([
            'user_id'   => auth()->user()->id,
            'titel'     => $data['titel'] ,
            'image'     => $data['image'] ,
            'content'   => $data['content'] ,
            
        ]);
        $post->push_post_public();
      
        return response()->json(['success'=> 'Successfully Pushed  Thought.'],200);
    }

}
