<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Salary;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Depense;
use App\Models\Prospect;
use App\Models\Sinistre;
use App\Models\Apporteur;
use App\Models\Avenant;
use App\Models\Compagnie;
use App\Models\FileAvenant;
use App\Models\FileSinistre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class StatController extends Controller
{
    public function synthese()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $clients = Client::where('id_entreprise', $user->id_entreprise)
            ->where('supprimer_client', 0)
            ->latest()
            ->paginate(10);

        return response()->json($clients);
    }

    public function detailsclient($id_client)
    {
        $clients = Client::findOrFail($id_client);

        $listescontrats = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->where('id_client', $clients->id_client)
            ->where('supprimer_contrat', 0)
            ->get();
        $listesinistres = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->where('id_client', $clients->id_client)
            ->where('supprimer_sinistre', 0)
            ->get();

        return response()->json(["clients" => $clients, "listescontrats" => $listescontrats, "listesinistres" => $listesinistres]);
    }


    public function infosinistre($id_sinistre)
    {
        $sinistres = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->findOrFail($id_sinistre);

        $files = FileSinistre::join("sinistres", 'file_sinistres.id_sinistre', '=', 'sinistres.id_sinistre')->where('id_contrat', $id_sinistre)->get();

        return response()->json(["sinistres" => $sinistres, "files" => $files]);
    }

    public function detailscontrats($id_contrat)
    {
        $contrats = Contrat::join("clients", 'contrats.id_client', '=', 'clients.id_client')->findOrFail($id_contrat);

        $files = FileAvenant::join("avenants", 'file_avenants.id_avenant', '=', 'avenants.id_avenant')->where('id_contrat', $id_contrat)->get();


        return response()->json(["contrats" => $contrats, "files" => $files]);
    }

    public function expiredata(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $filtre = $request->filtre;
        $debut = $request->date_debut;
        $fin = $request->date_fin;
        // dd($fin);

        $data = strlen($request->search);

        if ($data > 0) {

            $search = request('search');
            $contrats = Contrat::nonSupprimes()
                ->with('branche', 'client', 'apporteur', 'compagnie')
                ->where(function ($query) use ($search, $user) {
                    $query->whereHas('branche', function ($subquery) use ($search, $user) {
                        $subquery->where('nom_branche', 'like', "%$search%")
                            ->where('id_entreprise', '=', $user->id_entreprise);
                    })
                        ->orWhereHas('client', function ($subquery) use ($search) {
                            $subquery->where('nom_client', 'like', "%$search%")
                                ->orWhere('adresse_client', 'like', "%$search%")
                                ->orWhere('profession_client', 'like', "%$search%");
                        })
                        ->orWhereHas('apporteur', function ($subquery) use ($search) {
                            $subquery->where('nom_apporteur', 'like', "%$search%");
                        })
                        ->orWhereHas('compagnie', function ($subquery) use ($search) {
                            $subquery->where('nom_compagnie', 'like', "%$search%");
                        });
                })
                ->get();


            return response()->json($contrats);
        } else {
            if ($filtre == null) {
                $contrats = Contrat::nonSupprimes()
                    ->with('branche', 'client', 'apporteur', 'compagnie')
                    ->whereHas('branche', function ($query) use ($user) {
                        $query->where('id_entreprise', $user->id_entreprise);
                    })
                    ->get();


                return response()->json($contrats);
            } elseif ($filtre == "expire") {
                $date = date('Y-m-d');

                $contrats = Contrat::nonSupprimes()
                    ->with('branche', 'client', 'apporteur', 'compagnie')
                    ->whereHas('branche', function ($query) use ($user, $date) {
                        $query->where('id_entreprise', $user->id_entreprise)
                            ->where('expire_le', '<', $date);
                    })
                    ->get();

                return response()->json($contrats);
            } elseif ($filtre == "solde") {
                $contrats = Contrat::nonSupprimes()
                    ->solde()
                    ->with('branche', 'client', 'apporteur', 'compagnie')
                    ->whereHas('branche', function ($query) use ($user) {
                        $query->where('id_entreprise', $user->id_entreprise);
                    })
                    ->get();

                return response()->json($contrats);
            } elseif ($filtre == "nonsolde") {

                $contrats = Contrat::nonSupprimes()
                    ->nonSolde()
                    ->with('branche', 'client', 'apporteur', 'compagnie')
                    ->whereHas('branche', function ($query) use ($user) {
                        $query->where('id_entreprise', $user->id_entreprise);
                    })
                    ->get();

                return response()->json($contrats);
            } else if ($filtre == "reverse") {
                $contrats = Contrat::nonSupprimes()
                    ->reverse()
                    ->with('branche', 'client', 'apporteur', 'compagnie')
                    ->whereHas('branche', function ($query) use ($user) {
                        $query->where('id_entreprise', $user->id_entreprise);
                    })
                    ->get();

                return response()->json($contrats);
            } elseif ($fin != null) {

                $contrats = Contrat::nonSupprimes()
                    ->with('branche', 'client', 'apporteur', 'compagnie')
                    ->whereHas('branche', function ($query) use ($user) {
                        $query->where('id_entreprise', $user->id_entreprise);
                    })
                    ->whereBetween('expire_le', [$debut, $fin])
                    ->get();

                return response()->json($contrats);
            }
        }
    }

    public function statapporteur()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $apporteurs = Apporteur::where('id_entreprise', $user->id_entreprise)->where('supprimer_apporteur', 0)->get();

        return response()->json($apporteurs);
    }

    public function detailsapporteurs($id_apporteur)
    {
        $apporteurs = Apporteur::findOrFail($id_apporteur);

        $listescontrats = Avenant::join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('contrats.id_apporteur', $apporteurs->id_apporteur)
            ->where('supprimer_contrat', 0)
            ->get();

        $total = Avenant::join("contrats", 'contrats.id_contrat', '=', 'avenants.id_contrat')
            ->where('contrats.id_apporteur', $apporteurs->id_apporteur)
            ->where('supprimer_contrat', 0)
            ->sum('commission_apporteur');

        $sommes = round($total, 2);

        $totalpaye = Avenant::join("contrats", 'contrats.id_contrat', '=', 'avenants.id_contrat')
            ->where('contrats.id_apporteur', $apporteurs->id_apporteur)
            ->where('supprimer_contrat', 0)
            ->where('paye','=','OUI')
            ->sum('commission_apporteur');

        $sommepayes = round($totalpaye, 2);

        return response()->json(["apporteurs" => $apporteurs, "listescontrats" => $listescontrats, "sommes" => $sommes, "sommepayes" => $sommepayes]);
    }

    public function statsupprime()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $clients = Client::where('supprimer_client', 1)->where('id_entreprise', $user->id_entreprise)->get();
        $prospects = Prospect::where('supprimer_prospect', 1)->where('id_entreprise', $user->id_entreprise)->get();
        $branches = Branche::where('supprimer_branche', 1)->get();
        $apporteurs = Apporteur::where('supprimer_apporteur', 1)->get();
        $compagnies = Compagnie::where('supprimer_compagnie', 1)->get();
        $contrats = Contrat::join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('supprimer_contrat', 1)
            ->get();
        $sinistres = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->where('supprimer_sinistre', 1)
            ->get();

        return response()->json(["clients" => $clients, "prospects" => $prospects, "branches" => $branches, "apporteurs" => $apporteurs, "compagnies" => $compagnies, "contrats" => $contrats, "sinistres" => $sinistres]);
    }

    public function modulestat()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $users = User::where('id_entreprise', $user->id_entreprise)->count();
        $clients = Client::where('id_entreprise', $user->id_entreprise)->where('supprimer_client', 0)->count();
        $contrats = Contrat::where('id_entreprise', $user->id_entreprise)->where('supprimer_contrat', 0)->count();
        $sinistres = Sinistre::where('id_entreprise', $user->id_entreprise)->where('supprimer_sinistre', 0)->count();
        $depenses = Depense::where('id_entreprise', $user->id_entreprise)->count();
        $salaires = Salary::where('id_entreprise', $user->id_entreprise)->count();

        return response()->json(["users" => $users, "clients" => $clients, "contrats" => $contrats, "sinistres" => $sinistres, "depenses" => $depenses, "salaires" => $salaires]);
    }
}
