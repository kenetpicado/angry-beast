<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'model_id' => 'required',
            'model_type' => 'required',
            'name' => 'required',
            'quantity' => 'required',
            'reminder' => 'nullable|array',
            'reminder.date' => 'nullable|date',
            'reminder.name' => 'nullable|max:255'
        ];
    }
}
