<?php

namespace App\Repositories;

use App\Models\Client;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class RetrieveDataRepository.
 */
class RetrieveDataRepository extends BaseRepository
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

    public function getClient($user)
    {
        $clients = Client::select('uuidClient', 'adresse_client', 'civilite', 'email_client', 'fax_client', 'id_entreprise', 'nom_client', 'numero_client', 'postal_client', 'profession_client', 'supprimer_client', 'sync', 'tel_client', 'user_id')
            ->where('id_entreprise', $user->id_entreprise)
            ->get();

        return $clients;
    }
}
