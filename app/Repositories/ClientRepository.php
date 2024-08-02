<?php

namespace App\Repositories;

use App\Models\Client;
use Illuminate\Support\Facades\Log;
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


    public function clientList($data, $user)
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

    public function postClient(array $data, $user)
    {

        // Check if Prospect already exists
        if (Client::where([
            ['nom_client', $data['nom_client']],
            ['tel_client', $data['tel_client']],
            ['id_entreprise', $data['id_entreprise']],
        ])->exists()) {
            return response()->json(['message' => 'Client existant'], 422);
        }

        try {
            $clients = new Client();
            $clients->numero_client = $data['numero_client'];
            $clients->civilite = $data['civilite'];
            $clients->nom_client = $data['nom_client'];
            $clients->tel_client = $data['tel_client'];
            $clients->postal_client = $data['postal_client'];
            $clients->adresse_client = $data['adresse_client'];
            $clients->profession_client = $data['profession_client'];
            $clients->fax_client = $data['fax_client'];
            $clients->email_client = $data['email_client'];
            $clients->id_entreprise = $data['id_entreprise'];
            $clients->uuidClient = $data['uuidClient'];
            $clients->user_id = $user->id;
            $clients->save();

            return $clients;
        } catch (\Exception $e) {
            Log::error('Category creation failed: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the categories.'], 500);
        }
    }

    public function editClient($uuidClient)
    {
        $client = Client::where('uuidClient', $uuidClient)->first();
        return $client;
    }

    public function updateClient(array $data, $uuidClient, $user)
    {

        $client = Client::where('uuidClient', $uuidClient)->first();

        if ($client) {
            $client->update($data);

            $clients =  Client::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_client', 0)
                ->get();
            return $clients;
        }
    }

}
