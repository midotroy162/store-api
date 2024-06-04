<?php

namespace App\Repositorties;

use App\Models\Product;

class ProductRepository implements RepositoryInterface
{
    public $product;
    public function __construct(Product $product){
        $this->product = $product;
    }
    public function baseQuery($relations=[]){
        return $this->product->get();
    }
    public function getById($id){
        return $this->product->findOrFail($id);
    }
    public function store($params){
                return $this->product->create($params);
    }
    public function update($id,$params){
        $product = $this->getById($id);
        
        $product =($product->update($params));
  
        return $product;
    }
    public function delete($params){
        $product = $this->getById($params['id']);
        return $product->delete();
    }
}
