<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'sale_price',
        'avatar',
        'album',
        'description',
        'content',
        'keywords',
        'tags',
        'status',
        'frame_type_id',
        'is_hot'
    ];

    protected $casts = [
        'album' => 'array',   // Tự convert JSON <-> array
        'status' => 'boolean'
    ];


    public function frameType()
    {
        return $this->belongsTo(FrameType::class, 'frame_type_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
