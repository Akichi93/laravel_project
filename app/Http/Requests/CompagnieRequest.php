<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompagnieRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nom_compagnie' => 'required',
            // 'adresse_compagnie' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nom_compagnie.required' => 'Veuillez entrer le nom de la compagnie',
            // 'adresse_compagnie.required' => 'Veuillez selectionner l\' adresse de la compagnie',
        ];
    }
}
