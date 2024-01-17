<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdatePeople extends FormRequest
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

        $rules=[
            'name' => 'required|min:3|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('peoples')->ignore($this->people?->id)
            ],
            'cpf'=>'required|unique:peoples',
            'phone'=>'numeric|required|unique:peoples',
            'rg'=>'unique:peoples',
            'matricula'=>'unique:peoples|numeric|required',
            'office_id'=>'required',
        ];

        if ($this->method() === 'PUT') {
            $rules = [
                'name' => 'required|min:3|max:255,'.$this->id.',id',
                'email' => 'required|email|unique:peoples,email,'.$this->id.',id'
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
            'email.email' => 'O email precisa ser válido',
            'email.unique' => 'O email passado já está em uso!',
            'email.required' => 'O email é obrigatório!',
            'phone.numeric' => 'O telefone precisa ter apenas números',
            'phone.unique' => 'Esse telefone já está em uso',
            'phone.required' => 'O telefone é obrigatório!',
            'cpf.required' => 'O cpf é obrigatório!',
            'cpf.unique'=>'Esse cpf já está em uso',
            'rg.unique'=>'Esse RG já está em uso',
            'matricula.unique' => 'Essa matricula ja está em uso',
            'matricula.numeric'=>'A matricula precisa ser numérica',
            'office_id.required'=>'selecione um cargo!',
        ];
    }
}