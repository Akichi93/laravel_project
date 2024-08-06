<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompagnieResource extends JsonResource
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
            'uuidCompagnie' => $this->uuidCompagnie,
            'adresse_compagnie' => $this->adresse_compagnie,
            'code_compagnie' => $this->code_compagnie,
            'contact_compagnie' => $this->contact_compagnie,
            'email_compagnie' => $this->email_compagnie,
            'id_entreprise' => $this->id_entreprise,
            'nom_compagnie' => $this->nom_compagnie,
            'postal_compagnie' => $this->postal_compagnie,
            'supprimer_compagnie' => $this->supprimer_compagnie,
            'sync' => $this->sync,
            'user_id' => $this->user_id,
        ];
    }
}
