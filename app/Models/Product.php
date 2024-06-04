<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [ 'name', 'description', 'image', 'price','company','rating', 'discount_price', 'category_id'];
    // protected $guarded = ['id'];
    protected $table = 'products';
     public  function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }


    public function images()
    {
        return $this->hasMany(ProductColorImage::class,'product_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class,'product_id');
    }

  
}
