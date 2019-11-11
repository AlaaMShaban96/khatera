<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;
use Carbon\Carbon;

class add
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
       
        $request->headers->set('Accept', "application/json");
     
        
     

        return $next($request);
    }

    static public function check_date_of_post($request , Closure $next)
    {
       
        $post= Post::findOrFail( $request->route('post')->id);

      return  $post->delet_on >= Carbon::now() ?$next($request): redirect('api/notfound');
    }


    static public function check_post($request , Closure $next)
    {
       
    }

    
}
