<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Repositories\ClientRepository;
use App\Http\Traits\AuthenticatesUsers;
use App\Repositories\ResponseRepository;
use App\Repositories\RetrieveDataRepository;

class RetrieveDataController extends Controller
{
    use AuthenticatesUsers;
    protected $client;
    protected $response;
   

    public function __construct(RetrieveDataRepository $client, ResponseRepository $response)
    {
        $this->client = $client;
        $this->response = $response;
    }
    
    public function getClient()
    {
        $user = $this->getAuthenticatedUser();
        $clients = Client::select('uuidClient', 'adresse_client', 'civilite', 'email_client', 'fax_client', 'id_entreprise', 'nom_client', 'numero_client', 'postal_client', 'profession_client', 'supprimer_client', 'sync', 'tel_client', 'user_id')
            ->where('id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($clients);
    }
}
