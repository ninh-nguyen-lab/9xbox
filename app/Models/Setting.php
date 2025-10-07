<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = ['key', 'value'];

    // Trả về mảng key => value
    public static function allAsArray(): array
    {
        return self::pluck('value', 'key')->toArray();
    }

    // Lấy theo key
    public static function get(string $key, $default = null)
    {
        return self::where('key', $key)->value('value') ?? $default;
    }

    // Lưu nhiều settings
    public static function setMany(array $settings): void
    {
        foreach ($settings as $key => $value) {
            self::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
