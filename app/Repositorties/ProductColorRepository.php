<?php

namespace App\Repositorties;

use App\Models\ProductColorImage;

class ProductColorRepository implements RepositoryInterface
{
    public $productColor;
    public function __construct(ProductColorImage $productColor)
    {
        $this->productColor = $productColor;
    }
    public function baseQuery($relations = []){
        return $this->productColor->get();
    }
    public function getById($id){
        return $this->productColor->findOrFail($id);
    }
    public function store($params){
        return $this->productColor->create($params);
    }
    public function update($id,$params){
        $productColor = $this->getById($id);
        
        $productColor =($productColor->update($params));
  
        return $productColor;
    }
    public function delete($params){
        $productColor = $this->getById($params['id']);
        return $productColor->delete();
    }
}