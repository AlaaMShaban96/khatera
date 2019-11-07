<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;
use Request as Domain;
use Illuminate\Http\Request;
use App\Http\Resources\PostResources;
use App\Exceptions\AppCustomException;

class PostController extends Controller
{


    public function __construct()
    {
        $this->middleware('add');
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
           // 'delet_after' => 'required',
        ]);
        $data['delet_on'] = Carbon::now()->addDay($request->delet_after);
        $post = Post::create($data);
        $post->website_link = Domain::root() . '/api/post/' . $post->id;
        $post->save();


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
        dd(Carbon::now()->addDay(5));
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
