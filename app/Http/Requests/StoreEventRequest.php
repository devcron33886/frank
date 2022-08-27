<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('event_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'description' => [
                'required',
            ],
            'date' => [
                'date_format:'.config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
