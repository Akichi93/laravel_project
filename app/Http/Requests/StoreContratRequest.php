<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContratRequest extends FormRequest
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
            'id_branche' => 'required',
            'id_compagnie' => 'required',
            'id_client' => 'required',
            'id_apporteur' => 'required',
            'numero_police' => 'required',
            'souscrit_le' => 'required',
            'effet_police' => 'required',
            'heure_police' => 'required',
            'expire_le' => 'required|after:effet_police',
            'reconduction' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_branche.required' => 'Veuillez sélectionnez la branche',
            'id_compagnie.required' => 'Veuillez selectionner la compagnie',
            'id_client.required' => 'Veuillez selectionner un client',
            'id_apporteur.required' => 'Veuillez selectionnez  l\'apporteur',
            'numero_police.required' => 'Veuillez entrer le numéro de police',
            'souscrit_le.required' => 'Veuillez entrer la date de souscription',
            'effet_police.required' => 'Veuillez entrer la date d\'effet de police',
            'expire_le.after' => 'L\'échéance doit être une date postérieure à la police de l\'effet.',
            'heure_police.required' => 'Veuillez entrer l\'heure de police',
            'expire_le.required' => 'Veuillez entrer la date d\'expiration de la police',
            'reconduction.required' => 'Veuillez selectionnez la reconduction',
        ];
    }
}
