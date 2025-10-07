<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class SyncSettings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Đồng bộ các key cấu hình mặc định vào bảng settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $keys = [
            // Thông tin công ty
            'company_name',
            'company_email',
            'company_address',
            'company_phone',
            'company_favicon',
            'company_logo',
            'company_title',
            'company_keywords',
            'company_description',

            // Giới thiệu
            'introduce_image',
            'introduce_description',
            'introduce_content',

            // Bản đồ
            'map_content',
        ];

        $created = 0;

        foreach ($keys as $key) {
            $setting = Setting::firstOrCreate(['key' => $key], ['value' => '']);
            if ($setting->wasRecentlyCreated) {
                $this->info("Đã thêm key: {$key}");
                $created++;
            }
        }

        if ($created === 0) {
            $this->info('✅ Tất cả key đã tồn tại, không cần đồng bộ.');
        } else {
            $this->info("🎉 Đã thêm {$created} key mới vào bảng settings.");
        }

        return Command::SUCCESS;
    }
}
