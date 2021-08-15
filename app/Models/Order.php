<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'client_id',
        'total_price',
        'payment_method',
        'shipping_address',
        'transaction_id',
        'status',
        'delivery_person_id'
    ];
}
