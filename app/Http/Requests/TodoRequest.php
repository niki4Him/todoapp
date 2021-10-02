<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|max:100'
        ];
    }

    public function authorize()
    {
        return true;
    }
}
