<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // Method 1: return all columns
        // return parent::toArray($request); 

        // Method 2: return specific column
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'created_at' => $this->created_at->format('M d Y')
        ];
    }

    public function with($request)
    {
        // add new object in api
        return [
            'version' => '1.0.0',
            'author_url' => url('http://laravelapi.local/')
        ];
    }
}
