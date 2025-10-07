<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FrameRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $frameId = $this->route('frame');
        if (is_object($frameId) && method_exists($frameId, 'getKey')) {
            $frameId = $frameId->getKey();
        }

        $nameRule = $this->isMethod('post')
            ? Rule::unique('frames', 'name')
            : Rule::unique('frames', 'name')->ignore($frameId);

        $rules = [
            'name'        => ['required', 'string', 'max:255', $nameRule],
            'frame_type'  => ['required', 'exists:frame_types,id'],
            'price'       => ['nullable', 'numeric', 'min:0'],
            'sale_price'  => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'album.*'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'description' => ['required', 'string', 'min:10'],
            'content'     => ['nullable', 'string', 'min:20'],
            'keywords'    => ['nullable', 'string', 'max:255'],
            'tags'        => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:0,1'],
            'is_hot'      => ['nullable', 'in:0,1'],
        ];

        if ($this->isMethod('post')) {
            $rules['avatar'] = ['required', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'];
        } else {
            $rules['avatar'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Vui lòng nhập tên khung hình',
            'name.unique'          => 'Tên khung đã tồn tại.',
            'frame_type.required'  => 'Vui lòng chọn loại khung hình',
            'frame_type.exists'    => 'Loại khung không hợp lệ',
            'price.numeric'        => 'Giá phải là số',
            'price.min'            => 'Giá không được âm',
            'sale_price.numeric'   => 'Giá khuyến mãi phải là số',
            'sale_price.min'       => 'Giá khuyến mãi không được âm',
            'sale_price.lt'        => 'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'avatar.required'      => 'Vui lòng chọn ảnh đại diện',
            'avatar.image'         => 'Ảnh đại diện phải là file hình',
            'album.*.image'        => 'Mỗi ảnh trong album phải là file hình',
            'description.required' => 'Vui lòng nhập mô tả',
            'content.min'          => 'Nội dung tối thiểu 20 ký tự',
            'status.required'      => 'Vui lòng chọn trạng thái',
            'status.in'            => 'Trạng thái không hợp lệ',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'price'      => $this->price ? preg_replace('/[^\d]/', '', $this->price) : null,
            'sale_price' => $this->sale_price ? preg_replace('/[^\d]/', '', $this->sale_price) : null,
        ]);
    }
}
