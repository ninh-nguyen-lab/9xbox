<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::allAsArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(SettingRequest $request)
    {
        $data = $request->validated();

        // Gom các field file upload
        $fileFields = ['company_logo', 'company_favicon', 'introduce_image'];

        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                // Lấy file cũ trong DB
                $oldFile = Setting::get($field);
                $this->deleteOldFile($oldFile);

                // Upload file mới
                $data[$field] = $this->handleFileUpload($request, $field, 'uploads/settings');
            }
        }

        // Lưu setting
        Setting::setMany($data);

        return redirect()
            ->route('settings.index')
            ->with('success', __('messages.update_success', [], 'vi'));
    }

    /**
     * Upload file và trả về đường dẫn public
     */
    private function handleFileUpload(Request $request, string $field, string $folder): string
    {
        $file = $request->file($field);
        $path = $file->storeAs($folder, $file->getClientOriginalName(), 'public');
        return 'storage/' . $path;
    }

    /**
     * Xoá file cũ (nếu có)
     */
    private function deleteOldFile(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}
