<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AnimalRequest extends FormRequest
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
            'code' => [
                'required',
                Rule::unique('animals')->where('user_id', auth()->id())->ignore($this->route('animal'))
            ],
            'name' => ['nullable'],
            'specie_id' => ['nullable'],
            'photo' => ['nullable', 'file'],
            'details' => ['nullable', 'array']
        ];
    }
}
