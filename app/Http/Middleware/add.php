<?php

namespace App\Http\Middleware;

use Closure;

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
        
        // dd($request->post);
        // $this->wow($request);

        return $next($request);
    }

    public function wow(Post $post)
    {
        dd("wow");
    }
}
