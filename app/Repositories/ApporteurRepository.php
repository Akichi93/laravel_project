<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Avenant;
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
    protected $tauxapporteurs;
    protected $avenants;

    public function __construct(Apporteur $apporteurs, TauxApporteur $tauxapporteurs, Avenant $avenants)
    {
        $this->apporteurs = $apporteurs;
        $this->tauxapporteurs = $tauxapporteurs;
        $this->avenants = $avenants;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function apporteursList($data, $user)
    {
        // Vérifier si la clé 'q' existe dans le tableau $data
        $query = $data['q'] ?? '';

        if (!empty($query)) {
            $apporteurs = Apporteur::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_apporteur', '=', '0')
                ->where('nom_apporteur', 'like', '%' . $query . '%')
                ->get();
        } else {
            $apporteurs = Apporteur::where('supprimer_apporteur', '=', '0')->where('id_entreprise', $user->id_entreprise)->get();
        }

        return $apporteurs;
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
        return Apporteur::where('uuidApporteur', $uuidApporteur)->first();;
    }

    public function deleteApporteur($uuidApporteur, $user)
    {
        $apporteurs = Apporteur::where('uuidApporteur', $uuidApporteur)->first();
        $apporteurs->supprimer_apporteur = 1;
        $apporteurs->save();

        return Apporteur::where('supprimer_apporteur', '=', '0')->where('id_entreprise', $user->id_entreprise)->get();
    }


    public function updateApporteur($data, $uuidApporteur, $user)
    {
        $apporteur = Apporteur::where('uuidApporteur', $uuidApporteur)->first();
        $apporteur->nom_apporteur = $data['nom_apporteur'];
        $apporteur->email_apporteur = $data['email_apporteur'];
        $apporteur->contact_apporteur = $data['contact_apporteur'];
        $apporteur->adresse_apporteur = $data['adresse_apporteur'];
        $apporteur->code_postal = $data['code_postal'];
        $apporteur->save();

        return Apporteur::where('supprimer_apporteur', '=', '0')->where('id_entreprise', $user->id_entreprise)->get();;
    }

    public function getTauxApporteur($uuidApporteur, $user)
    {
        return TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
            ->join("apporteurs", 'taux_apporteurs.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('taux_apporteurs.uuidApporteur', $uuidApporteur)
            ->where('taux_apporteurs.id_entreprise', $user->id_entreprise)
            ->get();
    }

    public function getNameApporteur($uuidApporteur)
    {
        return Apporteur::select('nom_apporteur')->where('uuidApporteur', $uuidApporteur)->first();
    }

    public function getBrancheDiffApporteur($uuidApporteur)
    {
        // Branche de l'entreprise
        $getbranches = Branche::pluck('id_branche')->toArray();

        $result = TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
            ->where('taux_apporteurs.id_apporteur', $uuidApporteur)->pluck('branches.id_branche')->toArray();

        $array = array_diff($getbranches, $result);

        $branches = Branche::whereIn('id_branche', $array)->get();

        return $branches;
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



        return TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
            ->where('taux_apporteurs.id_apporteur', $data['id'])->get();;
    }

    public function updateTauxApporteur(array $data, $uuidTauxApporteur)
    {


        // $id_tauxapp = $data['id_tauxapp'];
        $taux = $data['taux'];
        $apporteurs = TauxApporteur::where('uuidTauxApporteur', $uuidTauxApporteur)->update(['taux' => $taux]);
        if ($apporteurs) {
            $apporteurs = TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
                ->where('taux_apporteurs.uuidApporteur', $data['uuidApporteur'])->get();

            return $apporteurs;
        }
    }

    public function infoApporteur($uuidApporteur)
    {
        return Avenant::select('*')
            ->where('uuidApporteur', $uuidApporteur)
            ->get();
    }

    public function getApporteur()
    {
        $apporteurs = Apporteur::orderBy('id_apporteur', 'DESC')
            ->where('id_entreprise', Auth()->user()->id_entreprise)
            ->where('supprimer_apporteur', 0)->get();

        return $apporteurs;
    }

    public function getSommeCommissionApporteur($uuidApporteur)
    {
        $apporteurs = Avenant::select('*')
            ->where('uuidApporteur', $uuidApporteur)
            ->get();

        $totalCommissions = $apporteurs->sum('commission');

        return $totalCommissions;
    }

    public function getSommeCommissionsApporteurPayer($uuidApporteur)
    {
        $apporteurs = Avenant::select('*')
            ->where('uuidApporteur', $uuidApporteur)
            ->where('payer_apporteur', '=', 1)
            ->get();

        $totalCommissions = $apporteurs->sum('commission');

        return $totalCommissions;
    }

    public function getAvenantByUuid($uuidAvenant)
    {
        return Avenant::where('uuidAvenant', $uuidAvenant)->first();
    }
}
