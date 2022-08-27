<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_edit');
    }

    public function rules()
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
