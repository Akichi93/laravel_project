<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'nom_client' => 'required',
            'tel_client' => 'required|numeric',
            'adresse_client' => 'required',
            'profession_client' => 'required',
            'email_client' => 'required|email|unique:clients',
        ];
    }

    public function messages()
    {
        return [
            'civilite.required' => 'Selectionnez la civilité',
            'nom_client.required' => 'Veuillez entrer le nom du client',
            'tel_client.required' => 'Veuillez entrer le contact de l\'apporteur',
            'tel_client.numeric' => 'Veuillez entrer un contact de',
            'adresse_client.required' => 'Veuillez entrer l\'adresse du client',
            'profession_client.required' => 'Veuillez entrer la profession du client',
            'email_client.required' => 'Veuillez entrer',
        ];
    }
}
