<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'dayfee',
        'addi_dayfee',
        'nightfee',
        'addi_nightfee',
        'paydriver',
    ];
}
