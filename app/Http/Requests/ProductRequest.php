<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productId = $this->route('product');
        if (is_object($productId) && method_exists($productId, 'getKey')) {
            $productId = $productId->getKey();
        }

        $nameRule = $this->isMethod('post')
            ? Rule::unique('products', 'name')
            : Rule::unique('products', 'name')->ignore($productId);

        $rules = [
            'name'        => ['required', 'string', 'max:255', $nameRule],
            'price'       => ['required', 'numeric', 'min:0'],
            'sale_price'  => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'album.*'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'description' => ['required', 'string', 'min:10'],
            'content'     => ['required', 'string', 'min:20'],
            'keywords'    => ['nullable', 'string', 'max:255'],
            'tags'        => ['nullable', 'string', 'max:255'],
            'status'      => ['required', 'in:0,1'],
        ];

        // Avatar rule
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
            'name.required'        => 'Vui lòng nhập tên sản phẩm',
            'name.unique'          => 'Tên sản phẩm đã tồn tại.',
            'price.required'       => 'Vui lòng nhập giá',
            'price.numeric'        => 'Giá phải là số',
            'price.min'            => 'Giá không được âm',
            'sale_price.lt'        => 'Giá khuyến mãi phải nhỏ hơn giá gốc',
            'avatar.required'      => 'Vui lòng chọn ảnh đại diện',
            'avatar.image'         => 'Ảnh đại diện phải là file hình',
            'album.*.image'        => 'Mỗi ảnh trong album phải là file hình',
            'description.required' => 'Vui lòng nhập mô tả',
            'content.required'     => 'Vui lòng nhập nội dung',
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
