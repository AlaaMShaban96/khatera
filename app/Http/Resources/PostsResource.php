<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsResource extends JsonResource
{ 
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        
        // return $this->resource->map(function ($item) {
        //     return [
        //         'titel' => $item->titel,
        //         'content' => $item->content
        //     ];
        // });
        
        // return $this->resource->where('public', true);
         return parent::toArray($request);
    }
}
