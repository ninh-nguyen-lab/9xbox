<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $blogId = $this->route('blog');
        if (is_object($blogId) && method_exists($blogId, 'getKey')) {
            $blogId = $blogId->getKey();
        }

        $titleRule = $this->isMethod('post')
            ? Rule::unique('blogs', 'title')
            : Rule::unique('blogs', 'title')->ignore($blogId);

        $rules = [
            'title'       => ['required', 'string', 'max:255', $titleRule],
            'description' => ['required', 'string', 'min:10'],
            'content'     => ['required', 'string', 'min:10'],
            'keywords'    => ['nullable', 'string', 'max:255'],
            'tags'        => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:0,1'],
        ];

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
            'title.required'       => 'Vui lòng nhập tiêu đề.',
            'title.max'            => 'Tiêu đề tối đa 255 ký tự.',
            'title.unique'         => 'Tiêu đề đã tồn tại, vui lòng chọn tiêu đề khác.',

            'description.required' => 'Vui lòng nhập mô tả.',
            'description.min'      => 'Mô tả phải ít nhất :min ký tự.',

            'content.required'     => 'Vui lòng nhập nội dung.',
            'content.min'          => 'Nội dung phải ít nhất :min ký tự.',

            'avatar.required'      => 'Vui lòng chọn ảnh đại diện.',
            'avatar.image'         => 'File phải là hình ảnh.',
            'avatar.mimes'         => 'Ảnh phải có định dạng: :values.',
            'avatar.max'           => 'Kích thước ảnh không vượt quá 2MB.',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in'       => 'Trạng thái không hợp lệ',
        ];
    }
}
