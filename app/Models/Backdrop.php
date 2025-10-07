<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backdrop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'avatar',
        'description',
        'keywords',
        'tags',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
