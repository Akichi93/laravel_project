<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Branche;
use App\Models\Prospect;
use Illuminate\Http\Request;
use App\Models\BrancheProspect;
use Illuminate\Support\Facades\Log;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProspectRepository.
 */
class ProspectRepository extends BaseRepository
{
    protected $prospects;

    public function __construct(Prospect $prospects)
    {
        $this->prospects = $prospects;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function getProspect($data, $user)
    {
        // Vérifier si la clé 'q' existe dans le tableau $data
        $query = $data['q'] ?? '';

        if (!empty($query)) {
            $prospects = Prospect::select('*')->where('nom_prospect', 'like', '%' . $query . '%')
                ->where('supprimer_prospect', '0')
                ->where('id_entreprise', $user->id_entreprise)
                ->get();
        } else {
            $prospects = Prospect::select('*')->where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '0')
                ->latest()
                ->get();
        }

        return $prospects;
    }


    public function postProspect(array $data, $user)
    {

        // Check if Prospect already exists
        if (Prospect::where([
            ['nom_prospect', $data['nom_prospect']],
            ['tel_prospect', $data['tel_prospect']],
        ])->exists()) {
            return response()->json(['message' => 'Prospect existant'], 422);
        }

        Log::info($data);

        try {

            $prospects = new Prospect();
            $prospects->civilite = $data['civilite'];
            $prospects->nom_prospect = $data['nom_prospect'];
            $prospects->postal_prospect = $data['postal_prospect'];
            $prospects->adresse_prospect = $data['adresse_prospect'];
            $prospects->tel_prospect = $data['tel_prospect'];
            $prospects->profession_prospect = $data['profession_prospect'];
            $prospects->fax_prospect = $data['fax_prospect'];
            $prospects->email_prospect = $data['email_prospect'];
            $prospects->id_entreprise = $data['id_entreprise'];
            $prospects->user_id = $user->id; // Assuming user_id is from the authenticated user
            $prospects->statut = $data['statut'];
            $prospects->uuidProspect = $data['uuidProspect'];
            $prospects->sync = 1;
            $prospects->etat = 0;
            $prospects->save();

            return $prospects;
        } catch (\Exception $e) {
            Log::error('Category creation failed: ' . $e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the categories.'], 500);
        }
    }


    public function editProspect($uuidProspect)
    {
        $prospects = Prospect::where('uuidProspect', $uuidProspect)->first();
        return $prospects;
    }

    public function updateProspect(array $data, $uuidProspect, $user)
    {

        $prospect = Prospect::where('uuidProspect', $uuidProspect)->first();

        if ($prospect) {
            $prospect->update($data);

            $prospects =  Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', 0)
                ->orderByDesc('uuidProspect')
                ->get();
            return $prospects;
        }
    }

    public function validateProspect(array $data, $uuidProspect, $user)
    {
        $prospects = Prospect::where('uuidProspect', $uuidProspect)->update([
            'etat' => 1,
        ]);


        $client = new Client();
        $client->numero_client = $data['numero_client'];
        $client->uuidClient = $data['uuidClient'];
        $client->civilite = $data['civilite'];
        $client->nom_client = $data['nom_prospect'];
        $client->tel_client = $data['tel_prospect'];
        $client->postal_client = $data['postal_prospect'];
        $client->adresse_client = $data['adresse_prospect'];
        $client->profession_client = $data['profession_prospect'];
        $client->fax_client = $data['fax_prospect'];
        $client->email_client = $data['email_prospect'];
        $client->id_entreprise = $data['id_entreprise'];
        $client->save();

        if ($prospects) {
            $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->get();

            return $prospects;
        }
    }

    public function deleteProspect(array $data, $uuidProspect, $user)
    {
        $prospects = Prospect::where('uuidProspect', $uuidProspect)->update([
            'supprimer_prospect' => $data['supprimer_prospect'],
        ]);

        if ($prospects) {

            $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->get();

            return $prospects;
        }
    }

    public function etatProspect($uuidProspect, array $data, $user)
    {
        $prospects = Prospect::where('uuidProspect', $uuidProspect)->update([
            'statut' => $data['statut'],
        ]);

        if ($prospects) {

            $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->get();

            return $prospects;
        }
    }


    public function getBrancheDiffProspect($uuidProspect, $user)
    {
        // Branche de l'entreprise
        $getbranches = Branche::where('id_entreprise', $user->id_entreprise)->pluck('id_branche')->toArray();

        $result = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('branche_prospects.id_prospect', $uuidProspect)->pluck('branches.id_branche')->toArray();

        $array = array_diff($getbranches, $result);

        $branches = Branche::whereIn('id_branche', $array)->get();

        return $branches;
    }

    public function postBrancheProspect(array $data, $uuidProspect,)
    {
        //Récupération des id
        $prospect = Prospect::where('uuidProspect', $uuidProspect)->value('id_prospect');
        $branche = Branche::where('uuidBranche', $data['uuidBranche'])->value('id_branche');

        //Insertion dans la bdd
        $prospects = new BrancheProspect();
        $prospects->uuidProspectBranche = $data['uuidProspectBranche'];
        $prospects->id_prospect = $prospect;
        $prospects->id_branche = $branche;
        $prospects->uuidProspect = $data['uuidProspect'];
        $prospects->uuidBranche = $data['uuidBranche'];
        $prospects->description = $data['description'];
        $prospects->id_entreprise = $data['id_entreprise'];
        $prospects->user_id = $data['id'];
        $prospects->save();

        if ($prospects) {
            $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
                ->where('branche_prospects.id_prospect', $uuidProspect)->get();

            return $prospects;
        }
    }

    public function getNameProspect($uuidProspect)
    {
        $names = Prospect::select('nom_prospect')->where('uuidProspect', $uuidProspect)->first();
        return $names;
    }

    public function getBrancheProspect($uuidProspect)
    {
        $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('uuidProspect', $uuidProspect)
            ->get();

        return $prospects;
    }

    public function getProspectExport($user)
    {

        $prospects = Prospect::select('adresse_prospect', 'civilite', 'email_prospect', 'etat', 'fax_prospect', 'id_entreprise', 'nom_prospect', 'user_id as id', 'profession_prospect', 'postal_prospect', 'statut', 'supprimer_prospect', 'sync', 'tel_prospect', 'uuidProspect')
            ->where('id_entreprise', $user->id_entreprise)
            // ->where('supprimer_prospect', 0)
            ->get();

        return $prospects;
    }

    public function getBrancheProspects($user)
    {

        $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('uuidProspect', $user->id_entreprise)
            ->get();

        return $prospects;
    }
}
