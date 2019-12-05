<?php

namespace App\Http\Controllers;

use App\Post;


use Illuminate\Http\Request;
use App\Exceptions\AppCustomException;

class PostController extends Controller
{


    public function __construct()
    {
        
    }
    public function index()
    {
       
    }
    public function show(Post $post)
    {  return  view("posts.post", compact("post"));
    }
 
    public function destroy(Post $post)
    {
        
    }
}
