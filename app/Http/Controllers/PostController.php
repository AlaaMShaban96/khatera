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
        // $this->middleware('add');
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
// dd("kpfiojeroif");

        $data = $request->validate([
            'titel' => 'required',
            'imge_link' => 'required',
            'text' => 'required',
           'delet_on' => 'required',
        ]);
        $data['delet_on'] = Carbon::now()->addDay($request->delet_on);
    //dd( $data['delet_on']);
        $post = Post::create($data);
        $post->website_link = Domain::root() . '/api/post/' . $post->id;
        $post->save();
        // dd( $post);


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
      //  dd("iiiiiiiiiiiiiiiii");
        return  view("posts.post", compact("post"));
    }
    public function NotFound()
    {
      // dd("iiiii;ljklnhj");
       return view('posts.notfound');
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
