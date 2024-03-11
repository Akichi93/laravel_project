<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutomobileRequest extends FormRequest
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
            'numero_immatriculation' => 'required',
            'identification_proprietaire' => 'required',
            'date_circulation' => 'required',
            'adresse_proprietaire' => 'required',
            'categorie_id' => 'required',
            'zone' => 'required',
            'energie_id' => 'required',
            'place' => 'required',
            'puissance' => 'required',
            'charge' => 'required',
            'valeur_neuf' => 'required',
            'valeur_venale' => 'required',
            'genre_id' => 'required',
            'categorie_socio_pro' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'numero_immatriculation.required' => 'Veuillez entrez  le numéro d immatriculation',
            'identification_proprietaire.required' => 'Veuillez entrer l identification du proprietaire !',
            'date_circulation.required' => 'Veuillez choisir la date  !',
            'adresse_proprietaire.required' => 'Veuillez entrer l adresse du proprietaire !',
            'categorie.required' => 'Veuillez selectionner la categorie !',
            'zone.required' => 'Veuillez selectionnez la zone !',
            'energie.required' => 'Veuillez selectionnez l energie !',
            'place.required' => 'Veuillez entrer le nombre de place !',
            'puissance.required' => 'Veuillez entrer la puissance !',
            'valeur_neuf.required' => 'Veuillez entrer la valeur à neuf !',
            'valeur_venale.required' => 'Veuillez entrer la valeur vénale !',
            'genre.required' => 'Veuillez selectionnez le genre !',
            'categorie_socio_pro.required' => 'Veuillez selectionnez le genre !',
        ];
    }
}
