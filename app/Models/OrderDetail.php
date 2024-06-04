<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
     protected $fillable = [ 'id', 'order_id', 'product_color_size_id', 'price', 'quantity','discount'];
    protected $table = 'order_details';
     public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function colors()
    {
        return $this->belongsTo(ProductColorImage::class);
    }
}
