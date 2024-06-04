<?php

namespace App\Services;
use App\Models\Product;
use App\Repositorties\ReviewRepository;


class ReviewService
{
    public $reviewRepository;
    public $product;
    public function __construct(ReviewRepository $repo,Product $product)
    {
        $this->reviewRepository = $repo;
        $this->product = $product;
    }
    public function getAll(){
        return $this->reviewRepository->baseQuery([]);
    }
        public function getById($params){
        return $this->reviewRepository->getbyId($params);
    }
    public function store($params){
        $params['user_id'] = auth('sanctum')->user()->id;
        $review = $this->reviewRepository->store($params);
            
            $product = Product::findOrFail($params['product_id']);
            $averageRating = $product->reviews()->avg('rating');
            $productRating= round((float) $averageRating,2);
            // dd()
            $product->update([
                'rating'=>$productRating
            ]);
            return $review;
    }
     public function update($id,$params){
        $review = $this->reviewRepository->update($id, $params);
        if(isset($params['rating'])){
            $product = Product::findOrFail($params['product_id']);
            $averageRating = $product->reviews()->avg('rating');
            $productRating= round((float) $averageRating,2);
            $product->update([
                'rating'=>$productRating
            ]);

        }
        return $review ;
       
    }
    public function delete($params){
        $review =$this->reviewRepository->delete($params);
        $product = Product::findOrFail($params['product_id']);
            $averageRating = $product->reviews()->avg('rating');
            $productRating= round((float) $averageRating,2);
            $product->update([
                'rating'=>$productRating
            ]);
        return $review ;
    }

}
