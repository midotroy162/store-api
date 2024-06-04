<?php

namespace App\Services;

use App\Repositorties\ProductColorRepository;
use App\Utils\ImageUpload;

class ProductColorService
{
    public $productColorRepository;
    public function __construct(ProductColorRepository $repo)
    {
        $this->productColorRepository = $repo;
    }
    public function getAll(){
        return $this->productColorRepository->baseQuery([]);
    }
    public function store($params){

        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image'],path:'/productcolor/');
        }
        return $this->productColorRepository->store($params);
    }
    public function getById($params){
        return $this->productColorRepository->getbyId($params);
    }
     public function update($id,$params){
        
        if (isset($params['image'])) {
            $params['image'] = ImageUpload::uploadImage($params['image'],path:'/productcolor/');
        }
        return $this->productColorRepository->update($id,$params);
    }
    public function delete($params){
        $this->productColorRepository->delete($params);
    }

}
