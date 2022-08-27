<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsletterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('newsletter_edit');
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
