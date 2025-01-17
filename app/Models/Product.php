<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_type',
        'product_brand_name',
        'product_description',
        'mrp_price_of_piece',
        'best_price_of_piece',
        'Num_of_piece_one_strip',
        'Num_of_strip_one_pack',
        'stock_quantity',
        'product_photo',
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
}
