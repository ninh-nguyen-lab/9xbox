<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'avatar',
        'tags',
        'keywords',
        'status',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
