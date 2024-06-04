<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColorImage extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'product_id', 'color','image'];
    protected $table = 'product_color_images';





    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
