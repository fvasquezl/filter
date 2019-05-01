<?php

namespace App\Http\Resources;


use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Userss extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'department' =>$this->department->name,
            'created_at' => $this->created_at->diffForHumans(),
            'posts' => Post::collection($this->posts)
            ];
    }
}
