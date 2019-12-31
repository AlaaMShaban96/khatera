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


        $data = $request->validatePost();

        $post = Post::firstOrCreate([
            'titel'     => $data['titel'] ,
            'image'     => $this->updateImage($request) ,
            'content'   => $data['content'] ,
        ]); 
        
        $post->CheckYourPost($request->period);
        
        return (new PostLinkResources($post))->response()->setStatusCode(200);

    }

    
    public function upload_store(Request $request)
    {

        $data = $request->validatePost();
    //   dd (  $data);
        
        $post = Post::firstOrCreate([
            'user_id'   => auth('api')->user()->id,
            'titel'     => $data['titel'] ,
            'image'     => $this->uploadeImage( $request) ,
            'content'   => $data['content'] ,
            'website_link'   => $data['website_link'] ,
            'period'   => $data['period'] ,
            'public'   => $data['public'] ,
            
        ]);
        // dd($post,$request->all());
        $post->push_post_public();

        $post->save();

        return response()->json(['success'=> 'Successfully Pushed  Thought.'],200);
    }
    private function uploadeImage(Request $request)
     {
   
        return  Storage::disk('public')->put("images", $request->file('image'));
     }
   

}
