<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BackdropRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $backdropId = $this->route('backdrop');
        if (is_object($backdropId) && method_exists($backdropId, 'getKey')) {
            $backdropId = $backdropId->getKey();
        }

        $nameRule = $this->isMethod('post')
            ? Rule::unique('backdrops', 'name')
            : Rule::unique('backdrops', 'name')->ignore($backdropId);

        $rules = [
            'name'        => ['required', 'string', 'max:255', $nameRule],
            'price'       => ['nullable', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'min:10'],
            'keywords'    => ['nullable', 'string', 'max:255'],
            'tags'        => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:0,1'],
        ];

        // Avatar rule
        if ($this->isMethod('post')) {
            $rules['avatar'] = ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'];
        } else {
            $rules['avatar'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'   => 'Vui lòng nhập tên phông nền',
            'name.unique'     => 'Tên phông nền đã tồn tại.',
            'price.numeric'   => 'Giá phải là số',
            'price.min'       => 'Giá không được âm',
            'avatar.required' => 'Vui lòng chọn ảnh đại diện',
            'avatar.image'    => 'Ảnh đại diện phải là file hình',
            'avatar.mimes'    => 'Ảnh phải có định dạng: :values',
            'avatar.max'      => 'Kích thước ảnh không vượt quá 2MB',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in'       => 'Trạng thái không hợp lệ',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'price' => $this->price ? preg_replace('/[^\d]/', '', $this->price) : null,
        ]);
    }
}
