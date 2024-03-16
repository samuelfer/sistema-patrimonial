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
            'cnpj' => 'numeric|unique:management_units',
            'phone' => 'numeric',
            'email' => 'email',
            'people_id' => 'required'
        ];

        if ($this->method() === 'PUT') {
            $rules = [
                'name' => 'required|min:3|max:255|unique:management_units,name,'.$this->id.',id',
                'cod'  => 'required|min:3|max:255|unique:management_units,cod,'.$this->id.',id',
                'cnpj'  => 'numeric|unique:management_units,cnpj,'.$this->id.',id',
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
            'cnpj.unique' => 'Esse cnpj já está em uso',
            'cnpj.numeric' => 'O cnpj precisa ter apenas números',
            'phone.numeric' => 'O telefone precisa ter apenas números',
            'email.email' => 'O email precisa ser válido',
            'people_id' => 'O responsável é obrigatório'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cnpj' =>  preg_replace('/[^0-9]/', '', $this->cnpj),
            'phone' =>  preg_replace('/[^0-9]/', '', $this->phone),
        ]);
    }
}
