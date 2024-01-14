<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateManagementUnit extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:management_units',
            'cod'  => 'required|min:3|max:255|unique:management_units',
            'description' => 'max:255',
            'cnpj' => 'numeric|cnpj|unique:management_units'
        ];

        if ($this->method() === 'PUT') {
            $rules = [
                'name' => 'required|min:3|max:255|unique:management_units,name,'.$this->id.',id',
                'cod'  => 'required|min:3|max:255|unique:management_units,cod,'.$this->cod.',cod',
                'cnpj'  => 'numeric|cnpj|unique:management_units,cnpj,'.$this->cod.',cnpj',
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.min' => 'O tamanho mínimo do nome é de 3 caracteres',
            'name.max' => 'O tamanho máximo do nome é de 255 caracteres',
            'name.unique' => 'Esse nome já está em uso',
            'cod.required' => 'O código é obrigatório',
            'cod.min' => 'O tamanho mínimo do código é de 3 caracteres',
            'cod.max' => 'O tamanho máximo do código é de 255 caracteres',
            'cod.unique' => 'Esse código já está em uso',
            'description.max' => 'O tamanho máximo permitido de 255 caracteres',
        ];
    }
}
