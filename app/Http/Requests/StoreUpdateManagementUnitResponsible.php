<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateManagementUnitResponsible extends FormRequest
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
            'people_id' => 'required',
            'management_unit_id'  => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
            'situation_id' => 'required',
        ];

        return $rules;
    }

    public function messages(): array
    {
        return [
            'people_id.required' => 'O responsável é obrigatório',
            // 'people_id.exists' => 'Selecione um responsável válido',
            'management_unit_id.required' => 'A unidade gestora é obrigatória',
            'date_start.required' => 'A data de início é obrigatória',
            'date_end.required' => 'O data de fim é obrigatória',
            'situation_id.required' => 'A situação é obrigatória',
        ];
    }
}
