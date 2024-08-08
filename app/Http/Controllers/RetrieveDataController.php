<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Apporteur;
use App\Models\Compagnie;
use Illuminate\Http\Request;
use App\Models\TauxApporteur;
use App\Models\TauxCompagnie;
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

    public function getCompagnie()
    {

        $user = $this->getAuthenticatedUser();
        $compagnies = Compagnie::select('adresse_compagnie', 'code_compagnie', 'contact_compagnie', 'email_compagnie', 'id_entreprise', 'nom_compagnie', 'postal_compagnie', 'supprimer_compagnie', 'sync', 'user_id', 'uuidCompagnie')
            ->where('id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($compagnies);
    }

    public function getTauxCompagnies()
    {
        $user = $this->getAuthenticatedUser();
        $compagnies = TauxCompagnie::select('uuidTauxCompagnie', 'compagnies.uuidCompagnie', 'taux_compagnies.sync', 'tauxcomp', 'branches.nom_branche', 'taux_compagnies.id_entreprise', 'branches.uuidBranche')
            ->join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
            ->join("compagnies", 'taux_compagnies.id_compagnie', '=', 'compagnies.id_compagnie')
            ->where('taux_compagnies.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($compagnies);
    }

    public function getApporteur()
    {
        $user = $this->getAuthenticatedUser();

        $apporteurs = Apporteur::select('adresse_apporteur', 'code_apporteur', 'code_postal', 'contact_apporteur', 'email_apporteur', 'user_id as id', 'id_entreprise', 'nom_apporteur', 'supprimer_apporteur', 'sync', 'uuidApporteur') 
            ->where('id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($apporteurs);
    }

    public function getTauxApporteurs()
    {
        $user = $this->getAuthenticatedUser();
        $apporteurs = TauxApporteur::select('uuidTauxApporteur', 'apporteurs.uuidApporteur', 'taux_apporteurs.sync', 'taux', 'branches.nom_branche', 'taux_apporteurs.id_entreprise', 'branches.uuidBranche')
            ->join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
            ->join("apporteurs", 'taux_apporteurs.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('taux_apporteurs.id_entreprise', $user->id_entreprise)
            ->get();
        return response()->json($apporteurs);
    }
}
