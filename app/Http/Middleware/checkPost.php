<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Carbon\Carbon;

class checkPost
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $post= Post::findOrFail( $request->route('post')->id);
        if ($post->delet_on >= Carbon::now()) {
          return  $next($request);
        }else {
            $post->delete();
            return  redirect('/notfound');
        }
           
        
    }
}
