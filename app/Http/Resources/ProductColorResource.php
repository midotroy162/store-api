<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductColorResource extends JsonResource
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
            "color"=>$this->color,
            'product_id' => $this->product_id,
            'image'=>$path,

            
        ];
    }
}
