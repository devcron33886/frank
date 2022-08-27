<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'order_no' => [
                'string',
                'required',
            ],
            'client_name' => [
                'string',
                'required',
            ],
            'client_phone' => [
                'string',
                'required',
            ],
            'shipping_address' => [
                'string',
                'required',
            ],
            'notes' => [
                'required',
            ],
            'shipping_amount' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'payment_type' => [
                'string',
                'nullable',
            ],
        ];
    }
}
