<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class AddToCart extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'add_to_cart'; 
    protected $fillable = [
        'user_id',
        'shop_id',
        'product_id',
        'quantity',
        'piece_strip_pack',
     ];

    /**
     * Define the relationship to the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship to the Product model.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
