<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use App\Models\Compagnie;
use Illuminate\Http\Request;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompagnieRequest;
use App\Repositories\CompagnieRepository;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompagnieController extends Controller
{
    protected $compagnie;

    public function __construct(CompagnieRepository $compagnie)
    {
        $this->compagnie = $compagnie;
    }


    /*
      |----------------------------------------------------
      | Liste des compagnies 
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste de tous les compagnies pour une entreorises 
      | spécifique qvec la possibilité de faire une recherche.
      |
     */
    public function compagnieList(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $data = strlen($request->q);
        if ($data > 0) {
            $compagnies['data'] = Compagnie::where('id_entreprise', $user->id_entreprise)->where('nom_compagnie', 'like', '%' . request('q') . '%')
                ->where('supprimer_compagnie', '=', '0')
                ->orWhere('adresse_compagnie', 'like', '%' . request('q') . '%')
                ->orWhere('code_compagnie', 'like', '%' . request('q') . '%')
                ->get();
            return response()->json($compagnies);
        } else {
            $compagnies = Compagnie::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_compagnie', '=', '0')->latest()->paginate(10);
            return response()->json($compagnies);
        }
    }

    /*
      |----------------------------------------------------
      | Ajoût des compagnies
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter
      | des compagnies.
      |
     */


    public function postCompagnie(CompagnieRequest $request)
    {

        // dd($request->all());
        // Validation du formulaire
        $validated = $request->validated();

        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->compagnie->postCompagnie($data);

        if ($Data) {
            $compagnies = Compagnie::where('id_entreprise', $data['id_entreprise'])
                ->where('supprimer_compagnie', '=', '0')->latest()->paginate(10);
            return response()->json($Data);
        }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Compagnie enregistré avec succès',
        //     'compagnie' => $Data
        // ], Response::HTTP_OK);
    }

    public function editCompagnie(int $id_compagnie)
    {
        $compagnies = Compagnie::findOrFail($id_compagnie);
        return response()->json($compagnies);
    }

    public function deleteCompagnie(Request $request, int $id_compagnie)
    {
        $compagnies = Compagnie::find($id_compagnie);
        $compagnies->supprimer_compagnie = 1;
        $compagnies->save();

        if ($compagnies) {
            $user =  JWTAuth::parseToken()->authenticate();
            $compagnies = Compagnie::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_compagnie', '=', '0')->latest()->paginate(10);

            return response()->json($compagnies);
        }
        // $Data = $this->compagnie->deleteCompagnie($id_compagnie);

        // return response()->json([
        //     'success' => true,
        //     'data' => $Data
        // ], Response::HTTP_OK);
    }

    public function updateCompagnie(Request $request, int $id_compagnie)
    {
        $compagnies = Compagnie::find($id_compagnie);
        $compagnies->nom_compagnie = request('nom_compagnie');
        $compagnies->email_compagnie = request('email_compagnie');
        $compagnies->contact_compagnie = request('contact_compagnie');
        $compagnies->adresse_compagnie = request('adresse_compagnie');
        $compagnies->save();

        if ($compagnies) {


            $compagnies = Compagnie::where('id_entreprise', $request->id_entreprise)
                ->where('supprimer_compagnie', '=', '0')->latest()->paginate(10);

            return response()->json($compagnies);
        }

        // $Data = $this->compagnie->updateCompagnie($id_compagnie);

        // return response()->json([
        //     'success' => true,
        //     'data' => $Data
        // ], Response::HTTP_OK);
    }

    public function getTauxCompagnie($id_compagnie)
    {
        $compagnies = TauxCompagnie::join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
            ->where('taux_compagnies.id_compagnie', $id_compagnie)->get();
        return response()->json($compagnies);
    }

    public function getTauxCompagnies()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $compagnies = TauxCompagnie::select('uuidTauxCompagnie', 'compagnies.uuidCompagnie', 'taux_compagnies.sync', 'tauxcomp', 'branches.nom_branche', 'taux_compagnies.id_entreprise', 'branches.uuidBranche')
            ->join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
            ->join("compagnies", 'taux_compagnies.id_compagnie', '=', 'compagnies.id_compagnie')
            ->where('taux_compagnies.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($compagnies);
    }

    public function getNameCompagnie($id_compagnie)
    {
        $names = Compagnie::select('nom_compagnie')->where('id_compagnie', $id_compagnie)->first();
        return response()->json($names);
    }

    public function editTauxCompagnie($id_tauxcomp)
    {
        $compagnies = $this->compagnie->editTauxCompagnie($id_tauxcomp);

        return response()->json($compagnies);
    }

    public function getBrancheDiffCompagnie($id_compagnie)
    {
        // Branche de l'entreprise
        $getbranches = Branche::where('supprimer_branche', 0)->pluck('id_branche')->toArray();

        $result = TauxCompagnie::join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
            ->where('taux_compagnies.id_compagnie', $id_compagnie)->where('supprimer_branche', 0)->pluck('branches.id_branche')->toArray();

        $array = array_diff($getbranches, $result);

        $branches = Branche::whereIn('id_branche', $array)->get();

        return response()->json($branches);
    }

    public function postTauxCompagnie(Request $request)
    {
        $data = $request->all();

        $id_compagnie = Compagnie::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('nom_compagnie', $data['name'])->pluck('id_compagnie')->first();

        $leads = $data['accidents'];  // valeur
        $firsts = $data['ids']; // id

        $array = array_combine($firsts, $leads);

        foreach ($array as $key => $value) {
            $compagnies = new TauxCompagnie();
            $compagnies->tauxcomp = $value;
            $compagnies->id_branche = $key;
            $compagnies->id_compagnie = $id_compagnie;
            $compagnies->save();
        }

        if ($compagnies) {
            $compagnies = TauxCompagnie::join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
                ->where('taux_compagnies.id_compagnie', $data['id'])->get();

            return response()->json($compagnies);
        }
        // $data = $request->all();
        // // Insertion dans la bdd
        // $Data = $this->compagnie->postTauxCompagnie($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Taux compagnie ajouté avec succès',
        //     'compagnie' => $Data
        // ], Response::HTTP_OK);
    }

    public function updateTauxCompagnie(Request $request)
    {
        $data = $request->all();

        $id_tauxcomp  = $data['id_tauxcomp'];
        $tauxcomp = $data['tauxcomp'];
        $compagnies = TauxCompagnie::where('id_tauxcomp', $id_tauxcomp)->update(['tauxcomp' => $tauxcomp]);

        if ($compagnies) {
            $compagnies = TauxCompagnie::join("branches", 'taux_compagnies.id_branche', '=', 'branches.id_branche')
                ->where('taux_compagnies.id_compagnie', $data['id'])->get();

            return response()->json($compagnies);
        }

        // Insertion dans la bdd
        // $Data = $this->compagnie->updateTauxCompagnie($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Taux compagnie modifié avec succès',
        //     'compagnie' => $Data
        // ], Response::HTTP_OK);
    }

    public function getCompagnie()
    {

        $user =  JWTAuth::parseToken()->authenticate();
        $compagnies = Compagnie::select('adresse_compagnie', 'code_compagnie', 'contact_compagnie', 'email_compagnie', 'id_entreprise', 'nom_compagnie', 'postal_compagnie', 'supprimer_compagnie', 'sync', 'user_id', 'uuidCompagnie')
            ->where('id_entreprise', $user->id_entreprise)
            // ->where('supprimer_compagnie', '=', '0')
            ->get();

        // $compagnies = $this->compagnie->getCompagnie();

        return response()->json($compagnies);
    }
}
