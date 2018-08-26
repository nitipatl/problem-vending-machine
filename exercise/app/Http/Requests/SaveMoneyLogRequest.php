<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveMoneyLogRequest extends FormRequest
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
            'values' => [
                'required',
                'array',
            ],
            'values.*' => [
                'integer',
                Rule::in(config('vending_machine.available_coins')),
            ],
            'status' => [
                'required',
                'integer',
                Rule::in(config('vending_machine.money_statuses')),
            ],
        ];
    }
}
