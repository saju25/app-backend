<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryRequest extends Model
{
    use HasFactory;

    // Table name (optional if the model name matches the table name in plural form)
    protected $table = 'delivery_requests';

    // Mass assignable attributes
    protected $fillable = [
        'driver_id',
        'order_id',
        'shop_id',
    ];
}
