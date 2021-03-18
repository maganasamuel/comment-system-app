<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_name' => $this->user_name,
            'message' => $this->message,
            'layer' => $this->layer,
            'children' => $this->children()->count(),
            // 'created_at' => $this->created_at->format('Y-m-d h:i:s'),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
