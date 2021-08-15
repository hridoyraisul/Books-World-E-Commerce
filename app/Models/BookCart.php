<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'client_id',
        'book_id',
        'quantity',
        'unit_price',
        'total_price'
    ];
}
