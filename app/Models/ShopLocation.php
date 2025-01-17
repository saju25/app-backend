<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopLocation extends Model
{
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'shop_id',
        'latitude',
        'longitude',
    ];

    // Define the relationship to the Shop model
     // Define the relationship to the Shop model
     public function shop()
     {
         return $this->belongsTo(Shop::class);
     }
}
