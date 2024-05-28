<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'code' => ['required'],
            'gender' => ['nullable'],
            'race' => ['nullable'],
            'initial_weight' => ['nullable', 'numeric'],
            'initial_height' => ['nullable', 'numeric'],
            'birth_date' => ['nullable', 'date'],
            'adoption_date' => ['nullable', 'date'],
            'entry_date' => ['nullable', 'date'],
            'photo' => ['nullable', 'image'],
            'user_id' => ['required', 'integer'],
        ];
    }
}
