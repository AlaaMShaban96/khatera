<?php

namespace App\Http\Resources;

use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PostsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowerResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data'=>[
               "followings" => $this->followers,
               //"posts"=>PostsResource::collection($this->whenLoaded('posts'))
            ]
          ];
      
    }
}
