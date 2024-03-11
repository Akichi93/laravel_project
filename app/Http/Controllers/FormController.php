<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Genre;
use App\Models\Marque;
use App\Models\Branche;
use App\Models\Couleur;
use App\Models\Energie;
use App\Models\Categorie;
use App\Models\Localisation;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\FormRepository;
use App\Http\Requests\BrancheRequest;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
    protected $localisation;
    protected $profession;
    protected $marque;
    protected $energie;
    protected $couleur;
    protected $categorie;
    protected $genre;
    protected $branche;
    protected $secteur;
    protected $role;
    protected $log;

    public function __construct(
        FormRepository $localisation,
        FormRepository $profession,
        FormRepository $marque,
        FormRepository $energie,
        FormRepository $couleur,
        FormRepository $categorie,
        FormRepository $genre,
        FormRepository $branche,
        FormRepository $secteur,
        FormRepository $role,
        FormRepository $log
    ) {
        $this->localisation = $localisation;
        $this->profession = $profession;
        $this->marque = $marque;
        $this->energie = $energie;
        $this->couleur = $couleur;
        $this->categorie = $categorie;
        $this->genre = $genre;
        $this->branche = $branche;
        $this->secteur = $secteur;
        $this->role = $role;
        $this->log = $log;
    }

    /*
      |----------------------------------------------------
      | Liste des villes et quartiers
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des villes et quartiers.
      |
     */

    public function getLocalisations()
    {
        // $localisations = Localisation::orderBy('nom_ville', 'ASC')->get();
        $localisations = $this->localisation->getLocalisations();

        return response()->json($localisations);
    }

    /*
      |----------------------------------------------------
      | Liste des professions
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des professions.
      |
     */

    public function getProfessions()
    {
        $professions = $this->profession->getProfessions();

        return response()->json($professions);
    }

    /*
      |----------------------------------------------------
      | Liste des marques
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des marques.
      |
     */

    public function getMarques()
    {
        $marques = Marque::orderBy('marque', 'ASC')->get();
        // $marques = $this->marque->getMarques();

        return response()->json($marques);
    }

    /*
      |----------------------------------------------------
      | Liste des energies
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des energies.
      |
     */

    public function getEnergies()
    {

        $energies = Energie::orderBy('energie', 'ASC')->get();
        // $energies = $this->energie->getEnergies();

        return response()->json($energies);
    }

    /*
      |----------------------------------------------------
      | Liste des couleurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des couleurs.
      |
     */

    public function getCouleurs()
    {

        $couleurs = Couleur::orderBy('couleur', 'ASC')->get();
        // $couleurs = $this->couleur->getCouleurs();

        return response()->json($couleurs);
    }

    /*
      |----------------------------------------------------
      | Liste des catégories
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des catégories.
      |
     */

    public function getCategories()
    {

        $categories = Categorie::all();
        // $categories = $this->categorie->getCategories();

        return response()->json($categories);
    }

    /*
      |----------------------------------------------------
      | Liste des genres
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des genres.
      |
     */

    public function getGenres()
    {
        $genres = $this->genre->getGenres();

        return response()->json($genres);
    }

    /*
      |----------------------------------------------------
      | Liste des branches
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des branches.
      |
     */

    public function getBranches()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $entreprise = $user->id_entreprise;

        $branches = Branche::where('supprimer_branche', '=', '0')
            ->where('id_entreprise', $entreprise)
            ->orderBy('created_at', 'DESC')
            ->get();
        // $branches = $this->branche->getBranches();

        return response()->json($branches);
    }

    /*
      |----------------------------------------------------
      | Liste des secteurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des secteurs.
      |
     */

    public function getSecteurs()
    {
        $secteurs = $this->secteur->getSecteurs();

        return response()->json($secteurs);
    }

    /*
      |----------------------------------------------------
      | Liste des roles
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des roles.
      |
     */

    public function getRoles()
    {
        $roles = Role::where('statut', 1)->get();
        // $roles = $this->role->getRoles();

        return response()->json($roles);
    }

    public function getRolesActif()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $roleactif = User::join("roles", 'users.id_role', '=', 'roles.id_role')->where('id', $user->id)->value('nom_role');
        // dd($roles);
        // $roles = $this->role->getRoles();

        return response()->json($roleactif);
    }

    /*
      |----------------------------------------------------
      | Liste des activités
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste des activités.
      |
     */


    public function getLog()
    {
        $logs = $this->log->getLog();

        return response()->json($logs);
    }

    /*
      |----------------------------------------------------
      | Ajoût des localisations
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter
      | des localisations.
      |
     */

    public function postLocalisations(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        $adresse = $data['ajout_adresse'];
        if (Localisation::where('nom_ville', '=', $adresse)->count() > 0) {
            return response()->json(['message' => 'Adresse existante'], 422);
        }
        $min = strtoupper($data['ajout_adresse']);

        $localisations = new Localisation();
        $localisations->nom_ville = $min;
        $localisations->save();

        if ($localisations) {
            $localisations = Localisation::orderBy('nom_ville', 'ASC')->get();

            return response()->json($localisations);
        }


        // return $localisations;

        // Insertion dans la bdd
        // $Data = $this->localisation->postLocalisations($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Localisation enregistré avec succès',
        //     'localisation' => $Data
        // ], Response::HTTP_OK);
    }

    public function postProfessions(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->profession->postProfessions($data);

        return response()->json([
            'success' => true,
            'message' => 'Profession enregistré avec succès',
            'profession' => $Data
        ], Response::HTTP_OK);
    }

    public function postMarques(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        $marque = $data['ajout_marque'];
        if (Marque::where('marque', '=', $marque)->count() > 0) {
            return response()->json(['message' => 'Marque existante'], 422);
        }
        $min = strtoupper($data['ajout_marque']);

        $marques = new Marque();
        $marques->marque = $min;
        $marques->save();

        if ($marques) {
            $marques = Marque::orderBy('marque', 'ASC')->get();


            return response()->json($marques);
        }



        // Insertion dans la bdd
        // $Data = $this->marque->postMarques($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Marque enregistré avec succès',
        //     'marque' => $Data
        // ], Response::HTTP_OK);
    }

    public function postEnergies(Request $request)
    {
        // Récupération des données
        $data = $request->all();


        $energie = $data['ajout_energie'];
        if (Energie::where('energie', '=', $energie)->count() > 0) {
            return response()->json(['message' => 'Energie existante'], 422);
        }
        $min = strtoupper($data['ajout_energie']);

        $energies = new Energie();
        $energies->energie = $min;
        $energies->save();

        if ($energies) {
            $energies = Energie::orderBy('energie', 'ASC')->get();

            return response()->json($energies);
        }


        // Insertion dans la bdd
        // $Data = $this->energie->postEnergies($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Energie enregistré avec succès',
        //     'energie' => $Data
        // ], Response::HTTP_OK);
    }

    public function postCouleurs(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        $couleur = $data['ajout_couleur'];
        if (Couleur::where('couleur', '=', $couleur)->count() > 0) {
            return response()->json(['message' => 'Couleur existante'], 422);
        }
        $min = strtoupper($data['ajout_couleur']);

        $couleurs = new Couleur();
        $couleurs->couleur = $min;
        $couleurs->save();

        if ($couleurs) {
            $couleurs = Couleur::orderBy('couleur', 'ASC')->get();
            // $couleurs = $this->couleur->getCouleurs();

            return response()->json($couleurs);
        }




        // Insertion dans la bdd
        // $Data = $this->couleur->postCouleurs($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Couleur enregistré avec succès',
        //     'couleur' => $Data
        // ], Response::HTTP_OK);
    }

    public function postCategories(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        $categorie = $data['ajout_cat'];
        if (Categorie::where('categorie', '=', $categorie)->count() > 0) {
            return response()->json(['message' => 'Categorie existante'], 422);
        }
        $min = strtoupper($data['ajout_cat']);

        $categories = new Categorie();
        $categories->categorie = $min;
        $categories->save();

        if ($categories) {
            $categories = Categorie::all();

            return response()->json($categories);
        }

        // Insertion dans la bdd
        // $Data = $this->categorie->postCategories($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Categorie enregistré avec succès',
        //     'categorie' => $Data
        // ], Response::HTTP_OK);
    }

    public function postGenres(Request $request)
    {
        // Récupération des données
        $data = $request->all();

        $genre = $data['ajout_genre'];
        if (Genre::where('genre', '=', $genre)->count() > 0) {
            return response()->json(['message' => 'Genre existant'], 422);
        }
        $min = strtoupper($data['ajout_genre']);

        $genres = new Genre();
        $genres->genre = $min;
        $genres->save();

        if ($genres) {
            $genres = Genre::all();

            return response()->json($genres);
        }


        // Insertion dans la bdd
        // $Data = $this->genre->postGenres($data);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Genre enregistré avec succès',
        //     'genre' => $Data
        // ], Response::HTTP_OK);
    }

    public function postBranches(BrancheRequest $request)
    {
        // Validation du formulaire
        $validated = $request->validated();

        $user = JWTAuth::parseToken()->authenticate();

        // Récupération des données
        $data = $request->all();

        // Insertion dans la bdd
        $Data = $this->branche->postBranches($data);

        if ($Data) {
            $branches = Branche::where('supprimer_branche', '=', '0')->where('id_entreprise', $user->id_entreprise)->orderBy('id_branche', 'DESC')->get();

            return response()->json($branches);
        }
    }
}
