<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateSectorResponsible extends FormRequest
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
            'sector_id'  => 'required|exists:organs,id',
            'people_id' => 'required|exists:peoples,id',
            'date_start' => 'required',
            'date_end' => 'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'people_id.required' => 'O responsável é obrigatório',
            'people_id.exists' => 'Selecione um responsável válido',
            'sector_id.required' => 'O Setor é obrigatório',
            'sector_id.exists' => 'Selecione um Setor válido',
            'date_start.required' => 'A data de início é obrigatória',
            'date_end.required' => 'O data de fim é obrigatória',
        ];
    }
}
