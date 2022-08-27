<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeSlideRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('home_slide_edit');
    }

    public function rules()
    {
        return [
            'header' => [
                'string',
                'nullable',
            ],
            'image' => [
                'required',
            ],
        ];
    }
}
