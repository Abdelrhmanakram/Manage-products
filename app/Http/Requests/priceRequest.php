<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class priceRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'price'      => 'required|numeric|min:0',
        ];
    }
}
