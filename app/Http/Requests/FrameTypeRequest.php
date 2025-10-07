<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FrameTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $frameTypeId = $this->route('frametype');
        if (is_object($frameTypeId) && method_exists($frameTypeId, 'getKey')) {
            $frameTypeId = $frameTypeId->getKey();
        }

        $nameRule = $this->isMethod('post')
            ? Rule::unique('frame_types', 'name')
            : Rule::unique('frame_types', 'name')->ignore($frameTypeId);

        return [
            'name'   => ['required', 'string', 'max:255', $nameRule],
            'status' => ['required', 'in:0,1'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên loại khung hình',
            'name.unique'   => 'Tên loại khung hình đã tồn tại.',
            'status.required' => 'Vui lòng chọn trạng thái',
            'status.in'      => 'Trạng thái không hợp lệ',
        ];
    }
}
