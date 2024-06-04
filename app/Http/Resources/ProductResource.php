<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $path ='/app/public'.$this->image;
        
        return [
            'id' => $this->id,
            "comapny"=>$this->company,
            'name' => $this->name,
            'rating' => $this->rating,
            'description' => $this->description,
            'price' => $this->price,
            'image'=>$path,
            'images'=>ProductColorResource::collection($this->whenLoaded('images')),
            'reviews'=>ReviewResource::collection($this->whenLoaded('reviews'))
            
        ];
    }
}
