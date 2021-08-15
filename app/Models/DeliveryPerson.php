<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryPerson extends Model
{
    use HasFactory;
    protected $table = 'delivery_people';
    protected $fillable = [
        'client_id',
        'name',
        'email',
        'phone',
        'dob',
        'gender',
        'driving_license',
        'completed_delivery',
        'address',
        'status',
        'dp'
    ];
}
