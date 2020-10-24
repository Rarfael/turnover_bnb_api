<?php

namespace App\Http\Requests;

use App\Domain\Money;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProduct extends FormRequest
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
            '*.name' => ['required', 'string'],
            '*.description' => ['required', 'string'],
            '*.price' => ['required', 'integer', 'min:0'],
            '*.currency' => ['required', 'string', Rule::in(Money::CURRENCIES_SUPPORTED)]
        ];
    }
}
