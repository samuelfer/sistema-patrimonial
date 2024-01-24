<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateOrganResponsible extends FormRequest
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
            'organ_id'  => 'required|exists:organs,id',
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
            'organ_id.required' => 'O Orgão é obrigatório',
            'organ_id.exists' => 'Selecione umOrgão válido',
            'date_start.required' => 'A data de início é obrigatória',
            'date_end.required' => 'O data de fim é obrigatória',
        ];
    }
}
