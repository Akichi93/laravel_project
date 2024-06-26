<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Branche;
use App\Models\Prospect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BrancheProspect;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProspectsController extends Controller
{
    public function prospectList(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();


        $data = strlen($request->q);
        if ($data > 0) {
            $prospects['data'] = Prospect::where('nom_prospect', 'like', '%' . request('q') . '%')
                ->where('supprimer_prospect', '=', '0')
                ->where('id_entreprise', $user->id_entreprise)
                ->get();
            return response()->json($prospects);
        } else {
            $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->latest()
                ->paginate(10);
            return response()->json($prospects);
        }
    }

    public function editProspect($uuidProspect)
    {
        $prospects = Prospect::where('uuidProspect', $uuidProspect)->first();
        return response()->json($prospects);
    }

    public function postProspect(Request $request)
    {
        //validation
        $rules = [
            'civilite' => 'required',
            'nom_prospect' => 'required',
            'tel_prospect' => 'required|digits:10',
            'adresse_prospect' => 'required',
            'profession_prospect' => 'required',
        ];

        $customMessages = [
            'civilite.required' => 'Selectionnez la civilité',
            'nom_prospect.required' => 'Veuillez entrer le nom du prospect',
            'tel_prospect.required' => 'Veuillez entrer le contact de l\'apporteur',
            'tel_prospect.digits' => 'Veuillez entrer un contact de 10 chiffres',
            'adresse_prospect.required' => 'Veuillez entrer l\'adresse du prospect',
            'profession_prospect.required' => 'Veuillez entrer la profession du prospect',
        ];

        $this->validate($request, $rules, $customMessages);

        $prospects = new Prospect();
        $prospects->civilite = $request->civilite;
        $prospects->nom_prospect = $request->nom_prospect;
        $prospects->postal_prospect = $request->postal_prospect;
        $prospects->adresse_prospect = $request->adresse_prospect;
        $prospects->tel_prospect = $request->tel_prospect;
        $prospects->profession_prospect = $request->profession_prospect;
        $prospects->fax_prospect = $request->fax_prospect;
        $prospects->email_prospect = $request->email_prospect;
        $prospects->id_entreprise = $request->id_entreprise;
        $prospects->user_id = $request->id;
        $prospects->statut = $request->etat;
        $prospects->uuidProspect = $request->uuidProspect;
        $prospects->sync = 1;
        $prospects->save();

        return response()->json($prospects);
    }

    public function updateProspect(Request $request, $uuidProspect)
    {

        $prospects = Prospect::where('uuidProspect', $uuidProspect)->update([
            'civilite' => $request->civilite, 'nom_prospect' => $request->nom_prospect, 'postal_prospect' => $request->postal_prospect, 'adresse_prospect' => $request->adresse_prospect, 'tel_prospect' => $request->tel_prospect, 'profession_prospect' => $request->profession_prospect, 'fax_prospect' => $request->fax_prospect, 'email_prospect' => $request->email_prospect,
        ]);

        if ($prospects) {
            $prospects =  Prospect::where('id_entreprise', $request->id_entreprise)
                ->where('supprimer_prospect', 0)
                ->orderByDesc('uuidProspect')
                ->get();

            return response()->json($prospects);
        }
        // $prospects = Prospect::find($id_prospect);
        // $prospects->civilite = request('civilite');
        // $prospects->nom_prospect = request('nom_prospect');
        // $prospects->postal_prospect = request('postal_prospect');
        // $prospects->adresse_prospect = request('adresse_prospect');
        // $prospects->tel_prospect = request('tel_prospect');
        // $prospects->profession_prospect = request('profession_prospect');
        // $prospects->fax_prospect = request('fax_prospect');
        // $prospects->email_prospect = request('email_prospect');
        // $prospects->save();

        // if ($prospects) {
        //     $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
        //         ->where('supprimer_prospect', '=', '0')
        //         ->latest()
        //         ->paginate(10);

        //     return response()->json($prospects);
        // }
    }

    public function validateProspect(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $prospects = Prospect::where('uuidProspect', $request->uuidProspect)->update([
            'etat' => 1,
        ]);

        // $lastID = Client::max('id_client');
        // if ($lastID == null) {
        //     $id = 1;
        //     $prefix = substr($request->nom_projet, 0, 2);
        //     $day = date('d');
        //     $month = date('m');
        //     $year = date('Y');
        //     $ref = '0' . '-' . $id . '-' . intval($month) . intval($day) . $year . strtoupper($prefix);
        // } else {
        //     $id = intval($lastID) + 1;
        //     $prefix = substr($request->nom_projet, 0, 2);
        //     $day = date('d');
        //     $month = date('m');
        //     $year = date('Y');
        //     $ref = '0' . '-' . $id . '-' . intval($month) . intval($day) . $year . strtoupper($prefix);
        // }


        $client = new Client();
        $client->numero_client = $request->numero_client;
        $client->civilite = $request->civilite;
        $client->nom_client = $request->nom_prospect;
        $client->tel_client = $request->tel_prospect;
        $client->postal_client = $request->postal_prospect;
        $client->adresse_client = $request->adresse_prospect;
        $client->profession_client = $request->profession_prospect;
        $client->fax_client = $request->fax_prospect;
        $client->email_client = $request->email_prospect;
        $client->id_entreprise = $request->id_entreprise;
        $client->save();

        if ($prospects) {
            $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->get();

            return response()->json($prospects);
        }
    }

    public function deleteProspect(Request $request, $id_prospect)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $prospects = Prospect::find($id_prospect);
        $prospects->supprimer_prospect = 1;
        $prospects->save();

        if ($prospects) {
            $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->get();

            return response()->json($prospects);
        }
    }

    public function etatProspect(Request $request, $id_prospect)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $prospects = Prospect::find($id_prospect);
        $prospects->statut = $request->etat;
        $prospects->save();

        if ($prospects) {
            $prospects = Prospect::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_prospect', '=', '0')
                ->get();

            return response()->json($prospects);
        }
    }

    public function getBrancheDiffProspect(Request $request, $uuidProspect)
    {

        $user =  JWTAuth::parseToken()->authenticate();
        // Branche de l'entreprise
        $getbranches = Branche::where('id_entreprise', $user->id_entreprise)->pluck('id_branche')->toArray();

        $result = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('branche_prospects.id_prospect', $uuidProspect)->pluck('branches.id_branche')->toArray();

        $array = array_diff($getbranches, $result);

        $branches = Branche::whereIn('id_branche', $array)->get();

        return response()->json($branches);
    }

    public function postBrancheProspect(Request $request)
    {

        //Récupération des id
        $prospect = Prospect::where('uuidProspect', $request->uuidProspect)->value('id_prospect');
        $branche = Branche::where('uuidBranche', $request->uuidBranche)->value('id_branche');

        //Insertion dans la bdd
        $prospects = new BrancheProspect();
        $prospects->uuidProspectBranche = $request->uuidProspectBranche;
        $prospects->id_prospect = $prospect;
        $prospects->id_branche = $branche;
        $prospects->uuidProspect = $request->uuidProspect;
        $prospects->uuidBranche = $request->uuidBranche;
        $prospects->description = $request->description;
        $prospects->id_entreprise = $request->id_entreprise;
        $prospects->user_id = $request->id;
        $prospects->save();

        if ($prospects) {
            $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
                ->where('branche_prospects.id_prospect', $request->uuidProspect)->get();

            return response()->json($prospects);
        }
    }

    public function getNameProspect(Request $request, $uuidProspect)
    {
        $names = Prospect::select('nom_prospect')->where('uuidProspect', $uuidProspect)->first();
        return response()->json($names);
    }

    public function getBrancheProspect(Request $request, $uuidProspect)
    {
        // $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
        //     ->where('branche_prospects.id_prospect', $request->prospect)->get();

        $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('uuidProspect', $uuidProspect)
            ->get();
        return response()->json($prospects);
    }

    public function getProspect()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $prospects = Prospect::select('adresse_prospect', 'civilite', 'email_prospect', 'etat', 'fax_prospect', 'id_entreprise', 'nom_prospect', 'user_id as id', 'profession_prospect', 'postal_prospect', 'statut', 'supprimer_prospect', 'sync', 'tel_prospect', 'uuidProspect')
            ->where('id_entreprise', $user->id_entreprise)
            // ->where('supprimer_prospect', 0)
            ->get();

        // $prospects = $this->apporteur->getApporteur();

        return response()->json($prospects);
    }

    public function getBrancheProspects()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('uuidProspect', $user->id_entreprise)
            ->get();

        return response()->json($prospects);
    }
}
