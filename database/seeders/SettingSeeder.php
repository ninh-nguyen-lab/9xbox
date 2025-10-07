<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run()
    {
        $keys = [
            'company_name',
            'company_email',
            'company_address',
            'company_phone',
            'company_favicon',
            'company_logo',
            'company_title',
            'company_keywords',
            'company_description',
            'introduce_image',
            'introduce_description',
            'introduce_content',
            'map_content'
        ];

        foreach ($keys as $key) {
            \App\Models\Setting::firstOrCreate(['key' => $key], ['value' => '']);
        }
    }
}
