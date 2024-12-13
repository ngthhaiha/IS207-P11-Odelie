<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'productId' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'productId.required' => 'Sản phẩm không được để trống.',
            'productId.exists' => 'Sản phẩm không tồn tại.',
            'quantity.required' => 'Số lượng không được để trống.',
            'quantity.integer' => 'Số lượng phải là số nguyên.',
            'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            'color.string' => 'Màu sắc phải là một chuỗi ký tự.',
            'size.string' => 'Kích cỡ phải là một chuỗi ký tự.',
        ];
    }
}
