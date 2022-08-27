<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreNewsletterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('newsletter_create');
    }

    public function rules()
    {
        return [
            'email' => [
                'string',
                'nullable',
            ],
        ];
    }
}
