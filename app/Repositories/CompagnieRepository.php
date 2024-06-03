<?php

namespace App\Repositories;

use App\Models\Branche;
use App\Models\Compagnie;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CompagnieRepository.
 */
class CompagnieRepository extends BaseRepository
{
    protected $compagnies;

    public function __construct(Compagnie $compagnies)
    {
        $this->compagnies = $compagnies;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function postCompagnie(array $data)
    {
        $compagnie = $data['nom_compagnie'];
    
        // Check if compagnie already exists
        if (Compagnie::where('nom_compagnie', $compagnie)->exists()) {
            return response()->json(['message' => 'Apporteur existant'], 422);
        }
    
        // Create new Compagnie
        $compagnies = new Compagnie();
        $compagnies->uuidCompagnie = $data['uuidCompagnie'];
        $compagnies->nom_compagnie = $data['nom_compagnie'];
        $compagnies->contact_compagnie = $data['contact_compagnie'];
        $compagnies->email_compagnie = $data['email_compagnie'];
        $compagnies->adresse_compagnie = $data['adresse_compagnie'];
        $compagnies->code_compagnie = $data['code_compagnie'];
        $compagnies->id_entreprise = $data['id_entreprise'];
        $compagnies->user_id = $data['id'];
        $compagnies->sync = 1;
        $compagnies->save();
    
        $compagnieId = $compagnies->id_compagnie;
    
        if (isset($data['unique'])) {
            // If 'unique' is set, get all branches
            $branches = Branche::all();
    
            foreach ($branches as $branche) {
                $uuidBranche = $branche->uuidBranche;
    
                // Create TauxCompagnie records for each branch
                $taux = new TauxCompagnie();
                $taux->uuidTauxCompagnie = \Ramsey\Uuid\Uuid::uuid4()->toString();
                $taux->uuidCompagnie = $data['uuidCompagnie'];
                $taux->uuidBranche = $uuidBranche;
                $taux->tauxcomp = $data['unique'];
                $taux->id_branche = $branche->id_branche;
                $taux->id_compagnie = $compagnieId;
                $taux->id_entreprise = $data['id_entreprise'];
                $taux->save();
            }
    
            return response()->json($compagnies, 201);
        } else {
            // If 'unique' is not set, handle 'accidents' and 'ids'
            $accidents = $data['accidents'];
            $ids = $data['ids'];
    
            // Get branches where uuidBranche is in $ids
            $branches = Branche::whereIn('uuidBranche', $ids)->get();
            $firsts = $branches->pluck('id_branche')->toArray();
    
            $array = array_combine($firsts, $accidents);
    
            foreach ($array as $key => $value) {
                // Retrieve uuidBranche for each branch by id_branche
                $uuidBranche = Branche::where('id_branche', $key)->value('uuidBranche');
    
                // Create TauxCompagnie records for each branch with corresponding tauxcomp
                $taux = new TauxCompagnie();
                $taux->uuidTauxCompagnie = \Ramsey\Uuid\Uuid::uuid4()->toString();
                $taux->uuidCompagnie = $data['uuidCompagnie'];
                $taux->uuidBranche = $uuidBranche;
                $taux->tauxcomp = $value;
                $taux->id_branche = $key;
                $taux->id_compagnie = $compagnieId;
                $taux->id_entreprise = $data['id_entreprise'];
                $taux->sync = 1;
                $taux->save();
            }
    
            return response()->json($compagnies, 201);
        }
    }
    

    public function deleteCompagnie(int $id_compagnie)
    {
        $compagnies = Compagnie::find($id_compagnie);
        $compagnies->supprimer_compagnie = 1;
        $compagnies->save();

        return $compagnies;
    }

    public function editTauxCompagnie($uuidTauxCompagnie)
    {
        return TauxCompagnie::where('uuidTauxCompagnie', $uuidTauxCompagnie)->first();
    }


    public function updateCompagnie(int $id_compagnie)
    {
        $compagnie = Compagnie::find($id_compagnie);
        $compagnie->nom_compagnie = request('nom_compagnie');
        $compagnie->email_compagnie = request('email_compagnie');
        $compagnie->contact_compagnie = request('contact_compagnie');
        $compagnie->adresse_compagnie = request('adresse_compagnie');
        $compagnie->save();

        return $compagnie;
    }

    public function postTauxCompagnie(array $data)
    {

        $id_apporteur = Compagnie::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('nom_compagnie', $data['name'])->pluck('id_compagnie')->first();

        $leads = $data['accidents'];  // valeur
        $firsts = $data['ids']; // id

        $array = array_combine($firsts, $leads);

        foreach ($array as $key => $value) {
            $taux = new TauxCompagnie();
            $taux->tauxcomp = $value;
            $taux->id_branche = $key;
            $taux->id_compagnie = $id_apporteur;
            $taux->save();
        }

        return $id_apporteur;
    }

    public function updateTauxCompagnie(array $data)
    {
        $id_tauxcomp  = $data['id_tauxcomp'];
        $tauxcomp = $data['tauxcomp'];
        $compagnies = TauxCompagnie::where('id_tauxcomp', $id_tauxcomp)->update(['tauxcomp' => $tauxcomp]);

        return $compagnies;
    }

    public function getCompagnie()
    {
        $compagnies = Compagnie::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('supprimer_compagnie', '=', '0')
            ->get();

        return $compagnies;
    }
}
