<?php

namespace App\Http\Controllers\Api;

use App\Post;



use Faker\Provider\Image;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\AppCustomException;

use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PostLinkResources;

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
            'image'     => $this->updateImage($request) ,
            'content'   => $data['content'] ,
        ]); 
        
 // dd($post->image);
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
    private function updateImage(Request $request)
     {
   
        return  Storage::disk('public')->put("images", $request->file('image'));
     }
   

}
