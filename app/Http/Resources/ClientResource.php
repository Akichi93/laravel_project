<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'uuidClient' => $this->uuidClient,
            'adresse_client' => $this->adresse_client,
            'civilite' => $this->civilite,
            'email_client' => $this->email_client,
            'fax_client' => $this->fax_client,
            'id_entreprise' => $this->id_entreprise,
            'nom_client' => $this->nom_client,
            'numero_client' => $this->numero_client,
            'postal_client' => $this->postal_client,
            'profession_client' => $this->profession_client,
            'supprimer_client' => $this->supprimer_client,
            'sync' => $this->sync,
            'tel_client' => $this->tel_client,
            'user_id' => $this->user_id,
        ];
    }
}
