<?php

namespace App\Services;

use App\Repositorties\ProductRepository;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Utils\ImageUpload;

class ProductService
{
    public $productRepository;
    public function __construct(ProductRepository $repo){
        $this->productRepository=$repo;
    }
    public function getAll(){

        return $this->productRepository->baseQuery([]);
    }
    public function getById($params){
        return $this->productRepository->getbyId($params);
    }
    public function store($params){
        
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image'],path:'/product/');
        }
        return $this->productRepository->store($params);
    }
     public function update($id,$params){
        
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image'],path:'product/');
        }
        return $this->productRepository->update($id,$params);
    }
    public function delete($params){
        $this->productRepository->delete($params);
    }
}