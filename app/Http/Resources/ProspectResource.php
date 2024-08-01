<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProspectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuidProspect' => $this->uuidProspect,
            'nom' => $this->nom_prospect,
            'email' => $this->email_prospect,
            'telephone' => $this->tel_prospect,
            'adresse' => $this->adresse_prospect,
            'etat' => $this->etat,
            'profession' => $this->profession_prospect,
            'postal' => $this->postal_prospect,
            // Ajoute d'autres champs nécessaires
        ];
    }
}
