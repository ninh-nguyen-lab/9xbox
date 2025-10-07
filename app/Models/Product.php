<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'sale_price',
        'rent_time',
        'avatar',
        'album',
        'description',
        'content',
        'keywords',
        'tags',
        'status',
    ];

    protected $casts = [
        'album' => 'array',
        'status' => 'boolean'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
