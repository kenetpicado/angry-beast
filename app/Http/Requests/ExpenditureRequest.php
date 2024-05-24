<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenditureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'model_id' => ['required', 'integer'],
            'model_type' => ['required', 'string'],
            'concept' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'quantity' => ['nullable', 'numeric'],
            'value' => ['required', 'numeric'],
        ];
    }
}
