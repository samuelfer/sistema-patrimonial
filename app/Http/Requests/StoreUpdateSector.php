<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSector extends FormRequest
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
            'name' => 'required|min:3|max:255|unique:sectors',
            'organ_id' => 'required',
            'description' => 'max:255'
        ];

        if ($this->sigla != null) {
            $rules = [
                'sigla'  => 'min:2|max:255|unique:sectors',
            ];
        }

        if ($this->method() === 'PUT') {
            $rules = [
                'name' => 'required|min:3|max:255|unique:sectors,name,'.$this->id.',id',
            ];

            if ($this->sigla != null) {
                $rules = [
                    'sigla'=> 'min:2|max:255|unique:sectors,sigla,'.$this->sigla.',sigla',
                ];
            }
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
            'organ_id.required' => 'O órgão é obrigatório',
            'sigla.unique' => 'Essa sigla já está em uso',
            'sigla.min' => 'O tamanho mínimo do sigla é de 3 caracteres',
            'sigla.max' => 'O tamanho máximo do sigla é de 255 caracteres',
            'sigla.unique' => 'Esse sigla já está em uso',
            'sigla.max' => 'O tamanho máximo permitido de 255 caracteres',
        ];
    }
}
