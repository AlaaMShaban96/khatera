<?php

namespace App\Http\Resources;

use App\Http\Resources\PostsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersWithPostsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       
         return $this->resource->map(function ($user) {
             return [
                'data'=>[
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'posts' => new PostsResource($user->posts)
                ]
             ];
        });
         
    }
}
