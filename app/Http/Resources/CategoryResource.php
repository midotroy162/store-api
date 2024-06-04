<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductResource;

class CategoryResource extends JsonResource
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
            'Name' => $this->name,
            'Image'=>$path,
            // 'Product'=>ProductResource::collection($this->whenLoaded('product')),
            
        ];
    }
    
}
