<?php

namespace App\Repositorties;



use App\Models\Review;
use Ramsey\Uuid\Type\Decimal;

class ReviewRepository implements RepositoryInterface
{
       public $review;
    public $product;
    public function __construct(Review $review)
    {
        $this->review = $review;
        
    }
    public function baseQuery($relations = []){
        return $this->review->get();
    }
    public function getById($id){
        return $this->review->with(['users'])->findOrFail($id);
    }
    public function store($params){
        return $this->review->create($params);
    }
    public function update($id,$params){
       $review = $this->getById($id);
        // dd($params['comment']);
        $review =$review->update($params);
  
        return $review;
    }
    public function delete($params){
        $review = $this->getById($params['id']);
        return $review->delete();
    }
}