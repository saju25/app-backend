<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dm extends Model
{
    use HasFactory;

    // Define the table name (optional if the table name follows Laravel conventions)
    protected $table = 'dm';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'user_id',
        'dm_name',
        'dm_address',
        'dm_phone',
        'dm_email',
        'face_photo',
        'id_card',
        'pdf_contract',
        'is_approved',
    ];

    // Define the relationship with the User model (assuming the 'user_id' field is referencing the users table)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function locations()
    {
        return $this->hasMany(DeliveryManLocation::class, 'delivery_man_id');
    }
}
