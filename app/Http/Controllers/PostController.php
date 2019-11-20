<?php

namespace App\Http\Controllers;

use App\Post;


use Illuminate\Http\Request;
use App\Http\Resources\PostResources;
use App\Exceptions\AppCustomException;

class PostController extends Controller
{


    public function __construct()
    {
        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $data = $request->validate([
            'titel' => 'required',
            'imge_link' => 'required',
            'text' => 'required',
           'delet_on' => 'required|numeric|min:0|not_in:0',
        ]);

        $post = Post::firstOrCreate([

            'titel'     => $data['titel'] ,
            'imge_link' => $data['imge_link'] ,
            'text'      => $data['text'] ,
           
        ]);
        
        $post->Check_your_post($request->delet_on);
        
        return response(new PostResources($post), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return  view("posts.post", compact("post"));
    }
 





    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
