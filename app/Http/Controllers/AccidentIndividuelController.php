<?php

namespace App\Http\Controllers;

use App\Models\Activite;
use App\Models\AssuranceTemporaire;
use App\Models\FraisMedical;
use App\Models\ReductionGroupe;
use App\Models\TarificateurAccident;
use App\Models\TarificateurFraisMedical;
use App\Models\TarificationAccident;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AccidentIndividuelController extends Controller
{
    

    public function getReductionGroupe()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $reductions = ReductionGroupe::select('uuidReductionGroupe', 'reduction_groupes.uuidCompagnie', 'compagnies.nom_compagnie', 'nbrePersonneMin', 'nbrePersonneMax', 'pourcentage', 'reduction_groupes.user_id as id', 'reduction_groupes.id_entreprise', 'reduction_groupes.sync')
            ->join("compagnies", 'reduction_groupes.id_compagnie', '=', 'compagnies.id_compagnie')
            ->where('reduction_groupes.id_entreprise', $user->id_entreprise)
            ->get();


        return response()->json($reductions);
    }

    public function getAssuranceTemporaire()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $assurances = AssuranceTemporaire::select('uuidAssuranceTemporaire', 'assurance_temporaires.uuidCompagnie', 'compagnies.nom_compagnie', 'nbreMoisMin', 'nbreMoisMax', 'pourcentage', 'assurance_temporaires.user_id as id', 'assurance_temporaires.id_entreprise', 'assurance_temporaires.sync')
            ->join("compagnies", 'assurance_temporaires.id_compagnie', '=', 'compagnies.id_compagnie')
            ->where('assurance_temporaires.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($assurances);
    }

  

    public function getTarificateurAccident()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $tarificateurs = TarificateurAccident::where('id_entreprise', $user->id_entreprise)->get();

        return response()->json($tarificateurs);
    }


    public function getTarificationAccident()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $tarifications = TarificationAccident::where('id_entreprise', $user->id_entreprise)->get();

        return response()->json($tarifications);
    }

    public function getActivite()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $activites = Activite::where('id_entreprise', $user->id_entreprise)->get();

        return response()->json($activites);
    }
}
