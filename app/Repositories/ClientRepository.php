<?php

namespace App\Repositories;

use App\Models\Client;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ClientRepository.
 */
class ClientRepository extends BaseRepository
{
    protected $clients;

    public function __construct(Client $clients)
    {
        $this->clients = $clients;
    }

    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }


    public function getClient($data, $user)
    {
        // Vérifier si la clé 'q' existe dans le tableau $data
        $query = $data['q'] ?? '';

        if (!empty($query)) {
            $clients = Client::where('id_entreprise', $user->id_entreprise)
                ->where('nom_client', 'like', '%' . $query . '%')
                ->orWhere('adresse_client', 'like', '%' . $query . '%')
                ->orWhere('numero_client', 'like', '%' . $query . '%')
                ->orWhere('profession_client', 'like', '%' . $query . '%')
                ->get();
        } else {
            $clients = Client::where('id_entreprise', $user->id_entreprise)->latest()->get();
        }

        return $clients;
    }
}
