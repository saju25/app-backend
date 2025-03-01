<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'delivery_address',
        'phone',
        'total',
        'driver_id',
        'status',
        'payment',
        'paymentid',
        'prescription_photo',
        'latitude',
        'longitude',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
