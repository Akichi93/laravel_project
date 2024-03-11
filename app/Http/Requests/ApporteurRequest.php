<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApporteurRequest extends FormRequest
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
            'nom_apporteur' => 'required',
            // 'email_apporteur' => 'unique:apporteurs',
            // 'adresse_apporteur' => 'required',
        ];
    }

    public function messages()
    {
        return [
            // 'nom_apporteur.required' => 'Veuillez entrer le nom de l\'apporteur',
            // 'email_apporteur.unique' => 'Veuillez entrer un autre email',
            'adresse_apporteur.required' => 'Veuillez entrer l\'adresse de l\'apporteur',
        ];
    }
}
