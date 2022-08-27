<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('shop_create');
    }

    public function rules(): array
    {
        return [
            'company_name' => [
                'string',
                'nullable',
            ],
            'phone_number_1' => [
                'string',
                'min:10',
                'max:13',
                'nullable',
            ],
            'phone_number_2' => [
                'string',
                'min:10',
                'max:13',
                'required',
            ],
            'whatsapp' => [
                'string',
                'min:10',
                'max:13',
                'required',
            ],
            'email_1' => [
                'required',
            ],
            'address' => [
                'string',
                'required',
            ],
        ];
    }
}
