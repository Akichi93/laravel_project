<?php

namespace App\Repositories;

use App\Models\Log;
use App\Models\Role;
use App\Models\Genre;
use App\Models\Marque;
use App\Models\Branche;
use App\Models\Couleur;
use App\Models\Energie;
use App\Models\Secteur;
use App\Models\Apporteur;
use App\Models\Categorie;
use App\Models\Compagnie;
use App\Models\Profession;
use App\Models\Localisation;
use App\Models\TauxApporteur;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use Tymon\JWTAuth\Facades\JWTAuth;
//use Your Model

/**
 * Class FormRepository.
 */
class FormRepository extends BaseRepository
{
    protected $localisations;
    protected $professions;
    protected $marques;
    protected $energies;
    protected $couleurs;
    protected $categories;
    protected $genres;
    protected $branches;
    protected $secteurs;
    protected $roles;
    protected $logs;

    public function __construct(
        Localisation $localisations,
        Profession $professions,
        Marque $marques,
        Energie $energies,
        Couleur $couleurs,
        Categorie $categories,
        Genre $genres,
        Branche $branches,
        Secteur $secteurs,
        Role $roles,
        Log $logs
    ) {
        $this->localisations = $localisations;
        $this->professions = $professions;
        $this->marques = $marques;
        $this->energies = $energies;
        $this->couleurs = $couleurs;
        $this->categories = $categories;
        $this->genres = $genres;
        $this->branches = $branches;
        $this->secteurs = $secteurs;
        $this->roles = $roles;
        $this->logs = $logs;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function getLocalisations()
    {
        return Localisation::orderBy('nom_ville', 'ASC')->get();
    }

    public function getProfessions()
    {
        return Profession::orderBy('profession', 'ASC')->get();
    }

    public function getMarques()
    {
        return Marque::orderBy('marque', 'ASC')->get();
    }

    public function getEnergies()
    {
        return Energie::orderBy('energie', 'ASC')->get();
    }

    public function getCouleurs()
    {
        return Couleur::orderBy('couleur', 'ASC')->get();
    }

    public function getCategories()
    {
        $categories = Categorie::all();

        return $categories;
    }

    public function getGenres()
    {
        return Genre::all();
    }

    public function getBranches()
    {
        return Branche::where('supprimer_branche', '=', '0')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function getSecteurs()
    {
        return Secteur::all();
    }

    public function getRoles()
    {
        return Role::where('statut', 1)->get();
    }

    public function getLog()
    {
        $entreprise = Auth::user()->id_entreprise;
        $logs = Log::join("users", 'logs.users', '=', 'users.id')->where('id_entreprise', $entreprise);

        return $logs;
    }

    public function postLocalisations(array $data)
    {
        $adresse = $data['ajout_adresse'];
        if (Localisation::where('nom_ville', '=', $adresse)->count() > 0) {
            return response()->json(['message' => 'Adresse existante'], 422);
        } else {
            $min = strtoupper($data['ajout_adresse']);

            $localisations = new Localisation();
            $localisations->nom_ville = $min;
            $localisations->save();

            return $localisations;
        }
    }

    public function postProfessions(array $data)
    {
        $profession = $data['ajout_profession'];
        if (Profession::where('profession', '=', $profession)->count() > 0) {
            return response()->json(['message' => 'Profession existante'], 422);
        } else {
            $min = strtoupper($data['ajout_profession']);

            $professions = new Profession();
            $professions->profession = $min;
            $professions->save();

            return $professions;
        }
    }

    public function postMarques(array $data)
    {
        $marque = $data['ajout_marque'];
        if (Marque::where('marque', '=', $marque)->count() > 0) {
            return response()->json(['message' => 'Marque existante'], 422);
        } else {
            $min = strtoupper($data['ajout_marque']);

            $marques = new Marque();
            $marques->marque = $min;
            $marques->save();

            return $marques;
        }
    }

    public function postEnergies(array $data)
    {
        $energie = $data['ajout_energie'];
        if (Energie::where('energie', '=', $energie)->count() > 0) {
            return response()->json(['message' => 'Energie existante'], 422);
        } else {
            $min = strtoupper($data['ajout_energie']);

            $energies = new Energie();
            $energies->energie = $min;
            $energies->save();

            return $energies;
        }
    }

    public function postCouleurs(array $data)
    {
        $couleur = $data['ajout_couleur'];
        if (Couleur::where('couleur', '=', $couleur)->count() > 0) {
            return response()->json(['message' => 'Couleur existante'], 422);
        } else {
            $min = strtoupper($data['ajout_couleur']);

            $Couleurs = new Couleur();
            $Couleurs->couleur = $min;
            $Couleurs->save();

            return $Couleurs;
        }
    }

    public function postCategories(array $data)
    {
        $categorie = $data['ajout_cat'];
        if (Categorie::where('categorie', '=', $categorie)->count() > 0) {
            return response()->json(['message' => 'Categorie existante'], 422);
        } else {
            $min = strtoupper($data['ajout_cat']);

            $categories = new Categorie();
            $categories->categorie = $min;
            $categories->save();

            return $categories;
        }
    }

    public function postGenres(array $data)
    {
        $genre = $data['ajout_genre'];
        if (Genre::where('genre', '=', $genre)->count() > 0) {
            return response()->json(['message' => 'Genre existant'], 422);
        } else {
            $min = strtoupper($data['ajout_genre']);

            $genres = new Genre();
            $genres->genre = $min;
            $genres->save();

            return $genres;
        }
    }

    public function postBranches(array $data)
    {
        $user =  JWTAuth::parseToken()->authenticate();

        

        $branche = $data['nom_branche'];
        if (Branche::where('nom_branche', '=', $branche)->where('id_entreprise', '=', $user->id_entreprise)->count() > 0) {
            return response()->json(['message' => 'Branche existante'], 422);
        }
        $min = strtoupper($data['nom_branche']);

        $branches = new Branche();
        $branches->nom_branche = $min;
        $branches->sync = 1;
        $branches->uuidBranche = $data['uuidBranche'];
        $branches->id_entreprise = $user->id_entreprise;
        $branches->save();

        $id = $branches->id;

        $now = now();

        $logs = new Log();
        $logs->id_entreprise = $user->id_entreprise;
        $logs->user_id = Auth::user()->id;
        $logs->date_log = $now;
        $logs->type = 'BRANCHE';
        $logs->action = 'CREATION DE BRANCHE';
        $logs->save();


        // Verifier si des apporteurs et compagnies existent
        $apporteurs = Apporteur::where('id_entreprise', $user->id_entreprise)->count();
        if ($apporteurs > 0) {
            //Recuperer les permissions du rôle
            $idapporteur = Apporteur::select('id_apporteur')
                ->where('id_entreprise', Auth::user()->id_entreprise)
                ->get();

            // dd($permissions);
            foreach ($idapporteur as $get) {
                $qwerty[] = $get->id_apporteur;
            }


            $lastID = Branche::where('id_entreprise', $user->id_entreprise)->max('id_branche');

            // Ajout des permissions
            for ($i = 0; $i < count($qwerty); $i++) {
                $assoc = new TauxApporteur();
                $assoc->id_branche = $lastID;
                $assoc->id_apporteur = $qwerty[$i];
                $assoc->taux = 0;
                $assoc->save();
            }
        }
        $compagnies = Compagnie::where('id_entreprise', $user->id_entreprise)->count();

        if ($compagnies > 0) {
            //Recuperer les compagnies de l'entreprise
            $idcompagnie = Compagnie::select('id_compagnie')
                ->where('id_entreprise', $user->id_entreprise)
                ->get();

            foreach ($idcompagnie as $get) {
                $azerty[] = $get->id_compagnie;
            }

            // Ajout des taux compagnies
            for ($i = 0; $i < count($azerty); $i++) {
                $assoc = new TauxCompagnie();
                $assoc->id_branche = $lastID;
                $assoc->id_compagnie = $azerty[$i];
                $assoc->tauxcomp = 0;
                $assoc->save();
            }

            // dd($compagnies);
            return $branches;
        }
    }
}
