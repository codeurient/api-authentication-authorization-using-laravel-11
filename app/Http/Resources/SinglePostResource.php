<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SinglePostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id'            => $this->id,
            'post_title'    => $this->title,
            'post_content'  => $this->content,
            'author_id'     => $this->user_id,
            'published_at'  => $this->created_at,
            'last_update'   => $this->updated_at,
        ];
    }
}
