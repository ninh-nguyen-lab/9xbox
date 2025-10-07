<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Company
            'company_name'        => 'required|string|max:255',
            'company_email'       => 'nullable|email|max:255',
            'company_address'     => 'required|string|max:255',
            'company_phone'       => 'required|string|max:20',
            'company_title'       => 'required|string|max:255',
            'company_keywords'    => 'required|string|max:500',
            'company_description' => 'required|string',

            'company_favicon' => [
                $this->routeIs('settings.update') ? 'nullable' : 'required',
                'file',
                'mimes:ico,png,jpg,jpeg',
                'max:1024',
            ],
            'company_logo' => [
                $this->routeIs('settings.update') ? 'nullable' : 'required',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:4096',
            ],

            // Introduce
            'introduce_image'       => 'nullable|image|mimes:jpeg,png,jpg,svg|max:4096',
            'introduce_description' => 'required|string|min:10',
            'introduce_content'     => 'required|string|min:10',

            // Map
            'map_content' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            // Company
            'company_name.required'        => 'Vui lòng nhập tên công ty',
            'company_email.email'          => 'Email không hợp lệ',
            'company_address.required'     => 'Vui lòng nhập địa chỉ',
            'company_phone.required'       => 'Vui lòng nhập số điện thoại',
            'company_title.required'       => 'Vui lòng nhập title',
            'company_keywords.required'    => 'Vui lòng nhập keywords',
            'company_description.required' => 'Vui lòng nhập description',

            'company_favicon.required'     => 'Favicon công ty là bắt buộc.',
            'company_favicon.mimes'        => 'Favicon chỉ cho phép jpeg,png,jpg,ico',
            'company_favicon.max'          => 'Favicon tối đa 1MB',

            'company_logo.required'        => 'Logo công ty là bắt buộc.',
            'company_logo.image'           => 'Logo phải là hình ảnh',
            'company_logo.mimes'           => 'Logo chỉ cho phép jpeg,png,jpg,svg',
            'company_logo.max'             => 'Logo tối đa 4MB',

            // Introduce
            'introduce_description.required' => 'Vui lòng nhập mô tả',
            'introduce_description.min'      => 'Mô tả phải có ít nhất 10 ký tự',
            'introduce_content.required'     => 'Vui lòng nhập nội dung',
            'introduce_content.min'          => 'Nội dung phải có ít nhất 10 ký tự',
            'introduce_image.image'          => 'Ảnh giới thiệu phải là hình ảnh',
        ];
    }
}
