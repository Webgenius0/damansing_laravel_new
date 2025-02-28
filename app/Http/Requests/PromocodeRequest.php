<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromocodeRequest extends FormRequest
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
            'code' => ['string', 'required', 'max:255'],
            'discount_type' => ['required', 'in:percentage,fixed'],
            'minimum_order_value' => ['nullable', 'integer'],
            'discount_value' => ['nullable'],
            'minimum_order_value' => ['nullable','integer'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'expires_at' => ['nullable','date'],
        ];
        
    }
}
