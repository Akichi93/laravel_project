<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Sinistre;
use App\Models\Apporteur;
use App\Models\Reglement;
use Illuminate\Support\Str;
use App\Models\FileSinistre;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
// use Tymon\JWTAuth\JWTAuth;

class SinistreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_sinistre)
    {
        $sinistres = Sinistre::findOrFail($id_sinistre);
        return response()->json($sinistres);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPolices(Request $request)
    {
        // try {
        // Get the token from the "Authorization" header

        $user =  JWTAuth::parseToken()->authenticate();

        $polices = Contrat::where('contrats.id_entreprise', $user->id_entreprise)->get();
        // dd($polices);
        return response()->json($polices);
        // } catch (\Exception $e) {
        //     $message = $e->getMessage();
        //     return view('errors.404', ['error' => $message]);
        // }
    }

    public function getPolice($id)
    {
        $contrat = Contrat::where('id_contrat', $id)->get()->first();
        $branche = Branche::where('id_branche', $contrat->id_branche)->get()->first();
        return response()->json(["contrat" => $contrat, "branche" => $branche]);
    }

    public function addSinistre(Request $request)
    {

        $user =  JWTAuth::parseToken()->authenticate();

        $sinitre = new Sinistre();
        $sinitre->id_contrat = $request->id_contrat;
        $sinitre->reference_compagnie = $request->reference_compagnie;
        $sinitre->gestion_compagnie = $request->gestion_compagnie;
        $sinitre->materiel_sinistre = $request->materiel_corporel;
        $sinitre->numero_sinistre = $request->numero_sinistre_agence;
        $sinitre->garantie_applique = $request->garantie_applique;
        $sinitre->lieu_sinistre = $request->lieu;
        $sinitre->ipp = $request->ipp;
        $sinitre->date_survenance = $request->date_survenance;
        $sinitre->heure = $request->heure;
        $sinitre->date_ouverture = $request->date_ouverture;
        $sinitre->date_declaration = $request->date_declaration;
        $sinitre->date_decla_compagnie = $request->date_declaration_compagnie;
        $sinitre->date_mission = $request->date_mission;
        $sinitre->recours_sinistre = $request->recours;
        $sinitre->id_entreprise = $user->id_entreprise;
        $sinitre->user_id = $user->id;
        $sinitre->accident_sinistre = $request->accident_adversaire;
        $sinitre->commentaire_sinistre = $request->commentaire;
        $sinitre->save();

        return response()->json(['success' => 'Sinistre ajouté avec succès']);
    }

    public function getSinistres(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $data = strlen($request->q);
        if ($data > 0) {
            $sinistres = Sinistre::where('id_entreprise', $user->id_entreprise)
                ->where('numero_sinistre', 'like', '%' . request('q') . '%')
                ->where('supprimer_sinistre', '=', '0')
                ->orderBy('sinistres.id_sinistre', 'DESC')
                ->get();
            return response()->json(["sinistres" => $sinistres]);
        } else {
            $sinistres = Sinistre::join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
                ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('sinistres.id_entreprise', $user->id_entreprise)
                ->where('supprimer_sinistre', '=', '0')
                ->latest('sinistres.created_at')
                ->paginate(10);

            return response()->json($sinistres);
        }
    }

    public function getSinistre(Request $request)
    {
        $data = $request->all();
        $sinistre = Sinistre::where('id_sinistre', $data['id'])->get()->first();
        $contrat = Contrat::where('id_contrat', $sinistre->id_contrat)->get()->first();
        $branche = Branche::where('id_branche', $contrat->id_branche)->get()->first();
        $file_sinistre = FileSinistre::where('id_sinistre', $sinistre->id_sinistre)->get();
        // dd($file_sinistre);
        return response()->json(["sinistre" => $sinistre, "contrat" => $contrat, "branche" => $branche, "file_sinistre" => $file_sinistre]);
    }

    public function addPiece(Request $request)
    {
        $data = $request->all();
        // dd($data);

        if ($request->hasFile('file')) {
            $ressource_tmp = $request->file('file');
            if ($ressource_tmp->isValid()) {
                //obtenir l'extension de l'file
                $extension = $ressource_tmp->getClientOriginalExtension();
                //Generer un nouveau nom d'file
                $ressource = request('file')->getClientOriginalName();
                $ressourceTitle = pathinfo($ressource, PATHINFO_FILENAME);
                $ressourceName = $ressourceTitle . '.' . $extension;
                $ressourcePath = 'images/piece_sinistres/';
                //charger l'image
                $ressource_tmp->move($ressourcePath, $ressourceName);
            }
        }

        $fichier = new FileSinistre();
        $fichier->nom_fichier = $ressourceName;
        $fichier->id_sinistre = $data['id_sinistre'];
        $fichier->titre = $data['titre'];
        $fichier->save();
        // $fichier->filesinistres()->attach($data['id_sinistre']);

        return response()->json(["sinistres" => "sinistres", "id_sinistre" => $data['id_sinistre']]);
    }
    // getApporteur
    public function getApporteur(Request $request)
    {
        $apporteurs = Apporteur::get();
        return response()->json(["apporteurs" => $apporteurs]);
    }

    public function addReglement(Request $request)
    {
        $data = $request->all();
        $rules = [
            'mode' => 'required',
            'type' => 'required',
            'nom' => 'required',
            'id_sinistre' => 'required',
        ];

        $customMessages = [
            'mode.required' => 'La présentation es requise SVP !',
            'type.required' => 'Type requis !',
            'nom.required' => 'Nom requis !',
            'id_sinistre.required' => 'Image requise !',
        ];
        $this->validate($request, $rules, $customMessages);

        $reglement = new Reglement();
        $reglement->id_sinistre = $data['id_sinistre'];
        $reglement->type_reglement = $data['type'];
        $reglement->nom = $data['nom'];
        $reglement->mode = $data['mode'];
        $reglement->montant = $data['montant'];
        $reglement->date_reglement = Carbon::now();
        $reglement->id_user = 1;

        $reglement->save();
        return response()->json(['success' => "Reglement ajouté avec succès", 'id_sinistre' => $data['id_sinistre']]);
    }

    public function getDataReglements(Request $request)
    {
        $reglements_compagnie = Reglement::where('id_sinistre', $request->sinistre)->get();
        $reglements_compagnie_sum = Reglement::where('id_sinistre', $request->sinistre)->sum('montant');
        $reglements_client_sum = Reglement::where('id_sinistre', $request->sinistre)->sum('montant');
        $reglements_client = Reglement::where('id_sinistre', $request->sinistre)->get();
        return response()->json(["reglements_compagnie" => $reglements_compagnie, "reglements_client" => $reglements_client, "reglements_compagnie_sum" => $reglements_compagnie_sum, "reglements_client_sum" => $reglements_client_sum]);
    }
    
    public function getDataReglement(Request $request)
    {
        $reglement = Reglement::where('id_reglement',  $request->id)->where('type_reglement', $request->type)->where('id_sinistre', $request->sinistre)->get()->first();
        return response()->json(["reglement" => $reglement]);
    }

    public function updateSinistre(Request $request, $id)
    {
        $data = $request->all();

        $sinistre = Sinistre::find($id);
        // dd($sinistre);

        $sinistre->id_contrat = $request->id_contrat;
        $sinistre->reference_compagnie = $request->reference_compagnie;
        $sinistre->gestion_compagnie = $request->gestion_compagnie;
        $sinistre->materiel_sinistre = $request->materiel_corporel;
        $sinistre->numero_sinistre = $request->numero_sinistre_agence;
        $sinistre->garantie_applique = $request->garantie_applique;
        $sinistre->lieu_sinistre = $request->lieu;
        $sinistre->ipp = $request->ipp;
        $sinistre->date_survenance = $request->date_survenance;
        $sinistre->heure = $request->heure;
        $sinistre->date_ouverture = $request->date_ouverture;
        $sinistre->date_declaration = $request->date_declaration;
        $sinistre->date_decla_compagnie = $request->date_declaration_compagnie;
        $sinistre->date_mission = $request->date_mission;
        $sinistre->recours_sinistre = $request->recours;
        $sinistre->expert = $request->expert;
        $sinistre->accident_sinistre = $request->accident_adversaire;
        $sinistre->commentaire_sinistre = $request->commentaire;
        $sinistre->update();
        return response()->json('Sinistre modifié');
    }

    public function changeReglement(Request $request, $id)
    {
        $data = $request->all();
        $reglement = Reglement::find($id);

        $reglement->id_sinistre = $data['id_sinistre'];
        $reglement->type_reglement = $data['type'];
        $reglement->nom = $data['nom'];
        $reglement->mode = $data['mode'];
        $reglement->montant = $data['montant'];
        $reglement->date_reglement = $data['date'];
        $reglement->update();
        return response()->json(['success' => "Reglement ajouté avec succès", 'id_sinistre' => $data['id_sinistre']]);
    }

    public function updateSinistreStatus($id)
    {
        $sinistre = Sinistre::where('id_sinistre', $id)->get()->first();

        if ($sinistre->etat == 0) {

            // dd("inactif");
            $sinistre->etat = 1;
            $sinistre->update();
        } elseif ($sinistre->etat == 1) {
            // dd("actif");
            $sinistre->etat = 0;
            $sinistre->update();
        }
        return response()->json('Status', 200);
    }

    public function supprime($id_sinistre)
    {
        $sinistres = Sinistre::find($id_sinistre);
        $sinistres->supprimer_sinistre = 1;
        $sinistres->save();

        return response()->json($sinistres);
    }

    public function getListSinistres()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $sinistres = Sinistre::select('clients.nom_client', 'numero_sinistre', 'branches.nom_branche', 'date_survenance', 'date_ouverture', 'sinistres.etat')
            ->join("contrats", 'sinistres.id_contrat', '=', 'contrats.id_contrat')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->where('sinistres.id_entreprise', $user->id_entreprise)
            ->where('supprimer_sinistre', '=', '0')
            ->latest('sinistres.created_at')
            ->get();

        return response()->json($sinistres);
    }

    public function getReglements()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $reglements = Reglement::where('id_entreprise', $user->id_entreprise)->get();

        return response()->json($reglements);
    }
}
