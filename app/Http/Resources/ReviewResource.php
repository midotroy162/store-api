<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            "rating"=>$this->rating,
            "comment"=>$this->comment,
            'product_id' => $this->product_id,
            // 'user_id' => $this->user_id,
            'users'=>UserResource::make($this->users),  
        ];
    }
}
