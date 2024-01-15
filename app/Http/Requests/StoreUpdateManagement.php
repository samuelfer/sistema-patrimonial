<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateManagement extends FormRequest
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

        $rules = [
            'start' => 'required',
            'end' => 'required',
        ];

        if ($this->method() === 'PUT') {
            $rules = [
                'start' => 'required',
                'end' => 'required',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'start.required' => 'O início da gestão é obrigatório',
            'end.required' => 'O fim da gestão é obrigatório',
        ];
    }
}
