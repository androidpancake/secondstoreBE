<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'cust_name' => 'required|exists:users,name',
            'cust_phone' => 'required',
            'cust_email' => 'required|exists:users,email',
            'amount' => 'required|integer|min:1',
            'cust_price' => 'required|integer',
            'product_id' => 'required|exists:product,id'
        ];
    }

    public function messages() {}
}
