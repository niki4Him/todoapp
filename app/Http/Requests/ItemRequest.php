<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'description' => 'nullable|max:500',
            'todo_id' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $response = response()->json([
            'message' => 'Invalid data send',
            'errors' => $errors->messages(),
        ], 422);
        throw new HttpResponseException($response);
    }
}
