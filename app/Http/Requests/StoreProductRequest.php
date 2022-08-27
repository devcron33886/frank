<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'qty' => [
                'string',
                'required',
            ],
            'price' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'measure' => [
                'string',
                'required',
            ],
            'minStock' => [
                'string',
                'nullable',
            ],
            'discount' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
