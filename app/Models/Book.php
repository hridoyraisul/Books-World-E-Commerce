<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'id',
        'client_id',
        'title',
        'description',
        'picture',
        'picture_caption',
        'tag',
        'reaction',
        'city',
        'area',
        'price',
        'quantity'
    ];
    protected $casts = [
        'tag'=> 'array'
    ];
}
