<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use App\Models\Apporteur;
use Illuminate\Http\Request;
use App\Models\TauxApporteur;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ApporteurRequest;
use App\Repositories\ApporteurRepository;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApporteurController extends Controller
{
    protected $apporteur;

    public function __construct(ApporteurRepository $apporteur)
    {
        $this->apporteur = $apporteur;
    }

    /*
      |----------------------------------------------------
      | Liste des apporteurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste de tous les apporteurs pour une entreorises 
      | spécifique qvec la possibilité de faire une recherche.
      |
     */

    public function apporteursList(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $data = strlen($request->q);
        if ($data > 0) {
            $apporteurs['data'] = Apporteur::orderBy('id_apporteur', 'DESC')
                ->where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_apporteur', '=', '0')
                ->where('nom_apporteur', 'like', '%' . request('q') . '%')
                ->get();
            return response()->json($apporteurs);
        } else {
            $apporteurs = Apporteur::where('supprimer_apporteur', '=', '0')->where('id_entreprise', $user->id_entreprise)->get();
            return response()->json($apporteurs);
        }
    }

    /*
      |----------------------------------------------------
      | Ajoût des apporteurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter
      | des apporteurs.
      |
     */

    public function postApporteur(Request $request)
    {
        // Validation du formulaire
        // $validated = $request->validated();

        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->apporteur->postApporteur($data);

        if ($Data) {
            $apporteurs = Apporteur::where('supprimer_apporteur', '=', '0')->where('id_entreprise', $data['id_entreprise'])->get();
            return response()->json($Data);
        }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Apporteur enregistré avec succès',
        //     'apporteur' => $Data
        // ], Response::HTTP_OK);
    }

    /*
      |----------------------------------------------------
      | Recupérer les infos apporteurs
      |----------------------------------------------------
      |
      | Cette fonction permet de recupérer les infos
      | des apporteurs en fonction de l'id.
      |
     */

    public function editApporteur($id_apporteur)
    {
        $apporteurs = $this->apporteur->editApporteur($id_apporteur);
        return response()->json($apporteurs);
    }

    /*
      |----------------------------------------------------
      | Supprimer  apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet de supprimer un apporteur.
      |
     */

    public function deleteApporteur(Request $request, $id_apporteur)
    {

        $apporteurs = Apporteur::find($id_apporteur);
        $apporteurs->supprimer_apporteur = 1;
        $apporteurs->save();
        if ($apporteurs) {
            $apporteurs = Apporteur::where('supprimer_apporteur', '=', '0')->where('id_entreprise', $request->id_entreprise)->latest()->get();

            return response()->json($apporteurs);
        }
        // $Data = $this->apporteur->deleteApporteur($id_apporteur);

        // return response()->json([
        //     'success' => true,
        //     'data' => $Data
        // ], Response::HTTP_OK);
    }

    /*
      |----------------------------------------------------
      | Recupérer les infos d'un taux
      |----------------------------------------------------
      |
      | Cette fonction permet de recupérer les infos
      | d'un taux en fonction de l'apporteur.
      |
     */

    public function editTauxApporteur($id_tauxapp)
    {
        $apporteurs = $this->apporteur->editTauxApporteur($id_tauxapp);
        return response()->json($apporteurs);
    }

    /*
      |----------------------------------------------------
      | Mise à jour  apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet de mettre à jour les infos
      | un apporteur d'un apporteur en fonction de son id.
      |
     */

    public function updateApporteur(Request $request, $id_apporteur)
    {

        $apporteurs = Apporteur::find($id_apporteur);
        $apporteurs->nom_apporteur = request('nom_apporteur');
        $apporteurs->email_apporteur = request('email_apporteur');
        $apporteurs->contact_apporteur = request('contact_apporteur');
        $apporteurs->adresse_apporteur = request('adresse_apporteur');
        $apporteurs->code_postal = request('code_postal');
        $apporteurs->save();

        if ($apporteurs) {
            $apporteurs = Apporteur::where('supprimer_apporteur', '=', '0')->where('id_entreprise', $request->id_entreprise)->latest()->paginate(10);

            return response()->json($apporteurs);
        }

        // $Data = $this->apporteur->updateApporteur($id_apporteur);
        // return response()->json([
        //     'success' => true,
        //     'data' => $Data
        // ], Response::HTTP_OK);
    }

    /*
      |----------------------------------------------------
      | Obtenir les taux  apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet d'obtenir la liste des taux d'un apporteur.
      |
     */

    public function getTauxApporteur($id_apporteur)
    {
        $apporteurs = TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
            ->join("apporteurs", 'taux_apporteurs.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('taux_apporteurs.id_apporteur', $id_apporteur)->get();
        return response()->json($apporteurs);
    }

    public function getTauxApporteurs()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $apporteurs = TauxApporteur::select('uuidTauxApporteur', 'apporteurs.uuidApporteur', 'taux_apporteurs.sync', 'taux', 'branches.nom_branche', 'taux_apporteurs.id_entreprise', 'branches.uuidBranche')
            ->join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
            ->join("apporteurs", 'taux_apporteurs.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->where('taux_apporteurs.id_entreprise', $user->id_entreprise)
            ->get();
        return response()->json($apporteurs);
    }

    public function getNameApporteur($id_apporteur)
    {
        $names = Apporteur::select('nom_apporteur')->where('id_apporteur', $id_apporteur)->first();
        return response()->json($names);
    }

    public function getBrancheDiffApporteur($id_apporteur)
    {
        // Branche de l'entreprise
        $getbranches = Branche::pluck('id_branche')->toArray();

        $result = TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
            ->where('taux_apporteurs.id_apporteur', $id_apporteur)->pluck('branches.id_branche')->toArray();

        $array = array_diff($getbranches, $result);

        $branches = Branche::whereIn('id_branche', $array)->get();

        return response()->json($branches);
    }

    public function postTauxApporteur(Request $request)
    {
        $data = $request->all();


        $leads = $data['accidents'];  // valeur
        $firsts = $data['ids']; // id

        $array = array_combine($firsts, $leads);

        foreach ($array as $key => $value) {
            $apporteurs = new TauxApporteur();
            $apporteurs->taux = $value;
            $apporteurs->id_branche = $key;
            $apporteurs->id_apporteur = $data['id'];
            $apporteurs->save();
        }

        if ($apporteurs) {
            $apporteurs = TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
                ->where('taux_apporteurs.id_apporteur', $data['id'])->get();

            return response()->json($apporteurs);
        }



        // Insertion dans la bdd
        // $Data = $this->apporteur->postTauxApporteur($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Taux apporteur ajouté avec succès',
        //     'compagnie' => $Data
        // ], Response::HTTP_OK);
    }

    public function updateTauxApporteur(Request $request)
    {
        $data = $request->all();

        $id_tauxapp = $data['id_tauxapp'];
        $taux = $data['taux'];
        $apporteurs = TauxApporteur::where('id_tauxapp', $id_tauxapp)->update(['taux' => $taux]);
        if ($apporteurs) {
            $apporteurs = TauxApporteur::join("branches", 'taux_apporteurs.id_branche', '=', 'branches.id_branche')
                ->where('taux_apporteurs.id_apporteur', $data['id'])->get();

            return response()->json($apporteurs);
        }

        // Insertion dans la bdd
        // $Data = $this->apporteur->updateTauxApporteur($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Taux compagnie modifié avec succès',
        //     'compagnie' => $Data
        // ], Response::HTTP_OK);
    }

    public function getApporteur()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $apporteurs = Apporteur::select('adresse_apporteur', 'code_apporteur', 'code_postal', 'contact_apporteur', 'email_apporteur', 'user_id as id', 'id_entreprise', 'nom_apporteur', 'supprimer_apporteur', 'sync', 'uuidApporteur')
            // ->orderBy('id_apporteur', 'DESC')
            ->where('id_entreprise', $user->id_entreprise)
            // ->where('supprimer_apporteur', 0)
            ->get();

        // $apporteurs = $this->apporteur->getApporteur();

        return response()->json($apporteurs);
    }
}
