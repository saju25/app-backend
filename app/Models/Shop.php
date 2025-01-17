<?php
// app/Models/Shop.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Shop extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = [
        'shop_name',
        'shop_description',
        'shop_address',
        'shop_phone',
        'shop_photo',
        'shop_email',
        'user_id',
        'shop_review',
        'shop_review_no',
        'approved',
    ];

  
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function location()
    {
        return $this->hasOne(ShopLocation::class);
    }
}
