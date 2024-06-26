<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Ramsey\Uuid\Type\Decimal;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['rating','comment', 'product_id', 'user_id'];
    protected $table = 'reviews';

     public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
     public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
   
}
