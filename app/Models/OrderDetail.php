<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'client_id',
        'book_id',
        'quantity',
        'unit_price',
        'total_price'
    ];
}
