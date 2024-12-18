<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WishlistRequest extends FormRequest
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
        ];
    }

    public function messages()
    {
        return [
            'productId.required' => 'Sản phẩm không được để trống.',
            'productId.exists' => 'Sản phẩm không tồn tại.',
        ];
    }
}
