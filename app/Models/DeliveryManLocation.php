<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryManLocation extends Model
{
    use HasFactory;

    // Table name (optional if the model name matches the table name in plural form)
    protected $table = 'delivery_man_locations';

    // Mass assignable attributes
    protected $fillable = [
        'delivery_man_id',
        'latitude',
        'longitude',
        'is_avialable',
    ];

    // Relationship with Delivery Man
    public function deliveryMan()
    {
        return $this->belongsTo(Dm::class, 'delivery_man_id');
    }
}
