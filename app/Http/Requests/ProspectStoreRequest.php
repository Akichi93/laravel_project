<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProspectStoreRequest extends FormRequest
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
        return [
            'civilite' => 'required',
            'nom_prospect' => 'required',
            'tel_prospect' => 'required|digits:10',
            'adresse_prospect' => 'required',
            'profession_prospect' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'civilite.required' => 'Selectionnez la civilité',
            'nom_prospect.required' => 'Veuillez entrer le nom du prospect',
            'tel_prospect.required' => 'Veuillez entrer le contact de l\'apporteur',
            'tel_prospect.digits' => 'Veuillez entrer un contact de 10 chiffres',
            'adresse_prospect.required' => 'Veuillez entrer l\'adresse du prospect',
            'profession_prospect.required' => 'Veuillez entrer la profession du prospect',
        ];
    }
}
