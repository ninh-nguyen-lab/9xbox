<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrameType extends Model
{
    protected $fillable = ['name', 'slug', 'status'];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function frames()
    {
        return $this->hasMany(Frame::class, 'frame_type_id');
    }
}
