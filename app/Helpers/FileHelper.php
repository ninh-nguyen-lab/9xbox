<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    /**
     * Upload 1 file
     */
    public static function uploadFile(UploadedFile $file = null, string $path = ''): ?string
    {
        if (!$file) {
            return null;
        }

        // Giữ tên gốc + timestamp (tránh trùng)
        $filename = time() . '_' . $file->getClientOriginalName();

        return $file->storeAs($path, $filename, 'public');
    }

    /**
     * Upload nhiều file
     */
    public static function uploadFiles($files, string $path = ''): array
    {
        $paths = [];

        if (!$files) {
            return $paths;
        }

        foreach ((array) $files as $file) {
            if ($file instanceof UploadedFile) {
                $paths[] = self::uploadFile($file, $path);
            }
        }

        return $paths;
    }

    /**
     * Xoá 1 file
     */
    public static function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Xoá nhiều file
     */
    public static function deleteFiles($paths): void
    {
        foreach ((array) $paths as $path) {
            self::deleteFile($path);
        }
    }
}
