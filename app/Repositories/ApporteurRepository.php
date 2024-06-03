<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Branche;
use App\Models\Apporteur;
use App\Models\TauxApporteur;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

//use Your Model

/**
 * Class ApporteurRepository.
 */
class ApporteurRepository extends BaseRepository
{
    protected $apporteurs;

    public function __construct(Apporteur $apporteurs)
    {
        $this->apporteurs = $apporteurs;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function postApporteur(array $data)
    {
        $apporteur = $data['nom_apporteur'];

        // Check if Apporteur already exists
        if (Apporteur::where('nom_apporteur', $apporteur)->exists()) {
            return response()->json(['message' => 'Apporteur existant'], 422);
        }

        DB::beginTransaction();
        try {
            Log::info($data);

            $apporteurs = new Apporteur();
            $apporteurs->uuidApporteur = $data['uuidApporteur'];
            $apporteurs->nom_apporteur = $data['nom_apporteur'];
            $apporteurs->contact_apporteur = $data['contact_apporteur'];
            $apporteurs->email_apporteur = $data['email_apporteur'];
            $apporteurs->adresse_apporteur = $data['adresse_apporteur'];
            $apporteurs->code_postal = $data['code_postal'];
            $apporteurs->code_apporteur = $data['code_apporteur'];
            $apporteurs->id_entreprise = $data['id_entreprise'];
            $apporteurs->user_id = $data['id'];
            $apporteurs->apporteur_url = bcrypt($data['code_apporteur']);
            $apporteurs->sync = 1;
            $apporteurs->save();

            $apporteurId = $apporteurs->id_apporteur;

            if (isset($data['unique'])) {
                $branches = Branche::all();

                foreach ($branches as $branche) {
                    $uuidBranche = $branche->uuidBranche;

                    $taux = new TauxApporteur();
                    $taux->uuidTauxApporteur = \Ramsey\Uuid\Uuid::uuid4()->toString();
                    $taux->uuidApporteur = $data['uuidApporteur'];
                    $taux->uuidBranche = $uuidBranche;
                    $taux->taux = $data['unique'];
                    $taux->id_branche = $branche->id_branche;
                    $taux->id_apporteur = $apporteurId;
                    $taux->id_entreprise = $data['id_entreprise'];
                    $taux->save();
                }
            } else {
                $leads = $data['accidents'];  // Array of values
                $ids = $data['ids']; // Array of UUIDs

                $branches = Branche::whereIn('uuidBranche', $ids)->get();
                $firsts = $branches->pluck('id_branche')->toArray();

                // Ensure that leads and firsts have the same number of elements
                if (count($firsts) !== count($leads)) {
                    throw new \Exception('The count of branches and leads does not match.');
                }

                $array = array_combine($firsts, $leads);

                foreach ($array as $key => $value) {
                    $uuidBranche = Branche::where('id_branche', $key)->value('uuidBranche');

                    if ($uuidBranche === null) {
                        Log::error("uuidBranche is null for id_branche: $key");
                        continue; // Skip this iteration if uuidBranche is null
                    }

                    Log::info("uuidBranche: $uuidBranche");

                    $taux = new TauxApporteur();
                    $taux->uuidTauxApporteur = \Ramsey\Uuid\Uuid::uuid4()->toString();
                    $taux->uuidApporteur = $data['uuidApporteur'];
                    $taux->uuidBranche = $uuidBranche;
                    $taux->taux = $value;
                    $taux->id_branche = $key;
                    $taux->id_apporteur = $apporteurId;
                    $taux->id_entreprise = $data['id_entreprise'];
                    $taux->save();
                }
            }

            DB::commit();
            return response()->json($apporteurs, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json(['message' => 'An error occurred while creating the apporteur.'], 500);
        }
    }


    public function editApporteur($uuidApporteur)
    {
        $apporteur = Apporteur::where('uuidApporteur', $uuidApporteur)->first();
        // return response()->json($clients);
        return $apporteur;
    }

    public function deleteApporteur(int $id_apporteur)
    {
        $apporteurs = Apporteur::find($id_apporteur);
        $apporteurs->supprimer_apporteur = 1;
        $apporteurs->save();

        return $apporteurs;
    }


    public function updateApporteur(int $id_apporteur)
    {
        $apporteur = Apporteur::find($id_apporteur);
        $apporteur->nom_apporteur = request('nom_apporteur');
        $apporteur->email_apporteur = request('email_apporteur');
        $apporteur->contact_apporteur = request('contact_apporteur');
        $apporteur->adresse_apporteur = request('adresse_apporteur');
        $apporteur->code_postal = request('code_postal');
        $apporteur->save();

        return $apporteur;
    }

    public function editTauxApporteur($uuidTauxApporteur)
    {
        return TauxApporteur::where('uuidTauxApporteur', $uuidTauxApporteur)->first();
    }

    public function postTauxApporteur(array $data)
    {

        // $id_apporteur = Apporteur::where('id_entreprise', Auth()->user()->id_entreprise)
        //     ->where('id_apporteur', $data['id'])->pluck('id_apporteur')->first();

        $leads = $data['accidents'];  // valeur
        $firsts = $data['ids']; // id

        $array = array_combine($firsts, $leads);

        foreach ($array as $key => $value) {
            $taux = new TauxApporteur();
            $taux->taux = $value;
            $taux->id_branche = $key;
            $taux->id_apporteur = $data['id'];
            $taux->save();
        }



        return $leads;
    }

    public function updateTauxApporteur(array $data)
    {
        $id_tauxapp = $data['id_tauxapp'];
        $taux = $data['taux'];
        $apporteurs = TauxApporteur::where('id_tauxapp', $id_tauxapp)->update(['taux' => $taux]);
        if ($apporteurs) {
            $apporteurs = TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
                ->where('taux_apporteurs.id_apporteur', $data['id'])->get();

            return $apporteurs;
        }
    }

    public function getApporteur()
    {
        $apporteurs = Apporteur::orderBy('id_apporteur', 'DESC')
            ->where('id_entreprise', Auth()->user()->id_entreprise)
            ->where('supprimer_apporteur', 0)->get();

        return $apporteurs;
    }
}
