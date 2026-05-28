<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,

            'slug' => $this->slug,

            'body' => $this->body,

            'current_status' => $this->current_status,

            'author' => [
                'id' => $this->user?->id,
                'name' => $this->user?->username,
            ],

            'categories' => $this->categories->pluck('name'),

            'comments_count' => $this->comments_count,

            'created_at' => $this->created_at?->toISOString(),
        ];
    }
}