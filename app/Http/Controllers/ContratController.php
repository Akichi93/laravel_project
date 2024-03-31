<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Log;
use App\Models\Client;
use App\Models\Avenant;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Garantie;
use App\Models\Sinistre;
use App\Models\Apporteur;
use App\Models\Compagnie;
use App\Models\Automobile;
use App\Models\FileAvenant;
use App\Models\TypeGarantie;
use Illuminate\Http\Request;
use App\Models\TauxApporteur;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\ContratRequest;
use App\Repositories\ContratRepository;
use App\Http\Requests\AutomobileRequest;
use App\Http\Requests\StoreContratRequest;
use Symfony\Component\HttpFoundation\Response;

class ContratController extends Controller
{
    protected $contrat;

    public function __construct(ContratRepository $contrat)
    {
        $this->contrat = $contrat;
    }

    public function contratList(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $data = strlen($request->q);
        if ($data > 0) {
            $contrats['data'] =  Contrat::join("clients", 'contrats.id_client', '=', 'clients.id_client')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('contrats.id_entreprise', $user->id_entreprise)
                ->where('supprimer_contrat', '=', '0')
                ->where('numero_police', 'like', '%' . request('q') . '%')
                ->orWhere('nom_client', 'like', '%' . request('q') . '%')
                ->orWhere('tel_client', 'like', '%' . request('q') . '%')
                ->orderBy('contrats.id_contrat', 'DESC')
                ->get();

            return response()->json($contrats);
        } else {

            $contrats = Contrat::join("clients", 'contrats.id_client', '=', 'clients.id_client')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('contrats.id_entreprise', $user->id_entreprise)
                ->where('supprimer_contrat', '=', '0')
                ->latest('contrats.created_at')
                ->paginate(10);
            return response()->json($contrats);
        }
    }

    public function editContrat($id_contrat)
    {
        $contrats = Contrat::findOrFail($id_contrat);
        return response()->json($contrats);
    }

    public function postContrat(StoreContratRequest $request)
    {
        $validated = $request->validated();
        // try {

        // recuperer l'id_branche
        $idBranche = Branche::where('uuidBranche', $request->id_branche)->value('id_branche');

        // recuperer l'id_client
        $idClient = Client::where('uuidClient', $request->id_client)->value('id_client');

        // recuperer l'id_compagnie
        $idCompagnie = Compagnie::where('uuidCompagnie', $request->id_compagnie)->value('id_compagnie');

        // recuperer l'id_apporteur
        $idApporteur = Apporteur::where('uuidApporteur', $request->id_apporteur)->value('id_apporteur');

        $contrats = new Contrat();
        $contrats->id_branche = $idBranche;
        $contrats->id_client = $idClient;
        $contrats->id_compagnie = $idCompagnie;
        $contrats->id_apporteur = $idApporteur;
        $contrats->uuidContrat = $request->uuidContrat;
        $contrats->numero_police = $request->numero_police;
        $contrats->souscrit_le = $request->souscrit_le;
        $contrats->effet_police = $request->effet_police;
        $contrats->heure_police = $request->heure_police;
        $contrats->expire_le = $request->expire_le;
        $contrats->reconduction = $request->reconduction;
        $contrats->prime_nette = $request->prime_nette;
        $contrats->frais_courtier = $request->frais_courtier;
        $contrats->accessoires = $request->accessoires;
        $contrats->cfga = $request->cfga;
        $contrats->taxes_totales = $request->taxes_totales;
        $contrats->primes_ttc = $request->primes_ttc;
        $contrats->gestion = $request->gestion;
        $contrats->commission_apporteur = $request->commission_apporteur;
        $contrats->commission_courtier = $request->commission_courtier;
        $contrats->id_entreprise = $request->id_entreprise;
        $contrats->user_id = $request->id;
        $contrats->save();

        $id = $contrats->id_contrat;

        $latestOrder = Avenant::latest()->first();

        $annee = date('Y');
        $mois = date('m');

        if ($latestOrder) {

            $nouvelId = $latestOrder->id + 1;
        } else {
            $nouvelId = intval($mois) . $annee . 0001;
        }

        $numeroFacture = $annee . '' . $mois . '' . $nouvelId;

        $avenants = new Avenant();
        $avenants->id_contrat = $id;
        $avenants->annee = Carbon::createFromFormat('Y-m-d', $request->souscrit_le)->format('Y');
        $avenants->mois = Carbon::createFromFormat('Y-m-d', $request->souscrit_le)->format('m');
        $avenants->type = "Terme";
        $avenants->prime_ttc = $request->primes_ttc;
        $avenants->retrocession = $request->retrocession;
        $avenants->commission = $request->commission_apporteur;
        $avenants->commission_courtier = $request->commission_courtier;
        $avenants->prise_charge = $request->prise_charge;
        $avenants->ristourne = $request->ristourne;
        $avenants->prime_nette = $request->prime_nette;
        $avenants->date_emission = $request->souscrit_le;
        $avenants->date_debut = $request->effet_police;
        $avenants->date_fin = $request->expire_le;
        $avenants->accessoires = $request->accessoires;
        $avenants->frais_courtier = $request->frais_courtier;
        $avenants->cfga = $request->cfga;
        $avenants->taxes_totales = $request->taxes_totales;
        $avenants->id_entreprise = $request->id_entreprise;
        $avenants->user_id = $request->id;
        $avenants->code_avenant = $numeroFacture;
        $avenants->uuidContrat = $request->uuidContrat;
        $avenants->save();

        // Obtenir le nom de la branche
        $branche = Branche::select('nom_branche')->where('id_branche', $request->id_branche)->value("nom_branche");


        if ($branche == "AUTOMOBILE" || $branche == "MOTO") {
            //Ajout d'autombile
            $autos = new Automobile();
            $autos->numero_immatriculation = $request->numero_immatriculation;
            $autos->identification_proprietaire = $request->identification_proprietaire;
            $autos->date_circulation = $request->date_circulation;
            $autos->adresse_proprietaire = $request->adresse_proprietaire;
            $autos->categorie = $request->categorie_id;
            $autos->marque = $request->marque_id;
            $autos->genre = $request->genre_id;
            $autos->type = $request->type;
            $autos->carosserie = $request->carosserie;
            $autos->couleur = $request->couleur_id;
            $autos->option = $request->option;
            $autos->entree = $request->entree;
            $autos->energie = $request->energie_id;
            $autos->place = $request->place;
            $autos->puissance = $request->puissance;
            $autos->charge = $request->charge;
            $autos->valeur_neuf = $request->valeur_neuf;
            $autos->valeur_venale = $request->valeur_venale;
            $autos->categorie_socio_pro = $request->categorie_socio_pro;
            $autos->permis = $request->permis;
            $autos->prime_nette = $request->prime_nette;
            $autos->frais_courtier = $request->frais_courtier;
            $autos->accessoires = $request->accessoires;
            $autos->cfga = $request->cfga;
            $autos->taxes_totales = $request->taxes_totales;
            $autos->primes_ttc = $request->primes_ttc;
            $autos->gestion = $request->gestion;
            $autos->commission_apporteur = $request->commission_apporteur;
            $autos->commission_courtier = $request->commission_courtier;
            $autos->zone = $request->zone;
            $autos->type_garantie = $request->type_garantie;
            $autos->id_contrat = $id;
            $autos->save();

            if ($request->nom_garantie != null) {
                $garanties = new Garantie();
                $garanties->nom_garantie = $request->tierce;
                $garanties->id_contrat = $id;
                $garanties->save();

                $id = Contrat::max('id_contrat');
                $ids = Garantie::max('id_garantie');
                // $ids = $garanties->id_garantie;


                $checkbox = $request->garantie;

                for ($i = 0; $i < count($checkbox); $i++) {
                    $assoc = new TypeGarantie();
                    // $assoc->id_contrat = $id;
                    $assoc->id_garantie = $ids;
                    $assoc->type_garantie = $checkbox[$i];
                    $assoc->save();
                }
            }
        }


        return response()->json($avenants);

        // } catch (\Exception $exception) {
        //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
        //     return response()->json(['message' => 'Contrat non enregistré'], 422);
        // }
    }

    public function deleteContrat($id_contrat)
    {
        $Data = $this->contrat->deleteContrat($id_contrat);

        return response()->json([
            'success' => true,
            'data' => $Data
        ], Response::HTTP_OK);
    }

    public function soldeContrat(Request $request)
    {
        $id = $request->id_contrat;

        $Data = $this->contrat->soldeContrat($id);

        return response()->json([
            'success' => true,
            'data' => $Data
        ], Response::HTTP_OK);
    }


    public function soldeAvenant(Request $request)
    {
        $id = $request->id_avenant;

        $id_contrat = Avenant::where('id_avenant', $request->id_avenant)->value('id_contrat');

        $avenants = Avenant::where('id_avenant', $id)->update([
            'solder' => 1,
        ]);


        // $Data = $this->contrat->soldeAvenant($id);

        if ($avenants) {
            $avenants = Avenant::select(
                'id_avenant',
                'type',
                'nom_compagnie',
                'numero_police',
                'nom_branche',
                'annee',
                'mois',
                'prime_ttc',
                'avenants.commission_courtier',
                'avenants.commission',
                'avenants.date_emission',
                'avenants.date_debut',
                'avenants.date_fin',
                'avenants.solder',
                'avenants.reverser',
            )
                ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('contrats.id_contrat', $id_contrat)
                ->where('supprimer_avenant', 0)
                ->get();

            return response()->json($avenants);
        }
    }

    public function reverseContrat(Request $request)
    {
        $id = $request->id_contrat;

        $id_contrat = Avenant::where('id_avenant', $request->id_avenant)->value('id_contrat');

        $avenants = Contrat::where('id_contrat', $id)->update([
            'reverse' => 1,
        ]);


        if ($avenants) {
            $avenants = Avenant::select(
                'id_avenant',
                'type',
                'nom_compagnie',
                'numero_police',
                'nom_branche',
                'annee',
                'mois',
                'prime_ttc',
                'avenants.commission_courtier',
                'avenants.commission',
                'avenants.date_emission',
                'avenants.date_debut',
                'avenants.date_fin',
                'avenants.solder',
                'avenants.reverser',
            )
                ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('contrats.id_contrat', $id_contrat)
                ->where('supprimer_avenant', 0)
                ->get();

            return response()->json($avenants);
        }

        // $Data = $this->contrat->reverseContrat($id);

        // return response()->json([
        //     'success' => true,
        //     'data' => $Data
        // ], Response::HTTP_OK);
    }

    public function reverseAvenant(Request $request)
    {
        $id = $request->id_avenant;

        $id_contrat = Avenant::where('id_avenant', $request->id_avenant)->value('id_contrat');

        $avenants = Avenant::where('id_avenant', $id)->update([
            'reverser' => 1,
        ]);

        if ($avenants) {
            $avenants = Avenant::select(
                'id_avenant',
                'type',
                'nom_compagnie',
                'numero_police',
                'nom_branche',
                'annee',
                'mois',
                'prime_ttc',
                'avenants.commission_courtier',
                'avenants.commission',
                'avenants.date_emission',
                'avenants.date_debut',
                'avenants.date_fin',
                'avenants.solder',
                'avenants.reverser',
            )
                ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('contrats.id_contrat', $id_contrat)
                ->where('supprimer_avenant', 0)
                ->get();

            return response()->json($avenants);
        }


        // $Data = $this->contrat->reverseAvenant($id);

        // return response()->json([
        //     'success' => true,
        //     'data' => $Data
        // ], Response::HTTP_OK);
    }


    public function getAvenantContrat($id_contrat)
    {
        $avenants = Avenant::select(
            'id_avenant',
            'type',
            'nom_compagnie',
            'numero_police',
            'nom_branche',
            'annee',
            'mois',
            'prime_ttc',
            'avenants.commission_courtier',
            'avenants.commission',
            'avenants.date_emission',
            'avenants.date_debut',
            'avenants.date_fin',
            'avenants.solder',
            'avenants.reverser',
        )
            ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->where('contrats.id_contrat', $id_contrat)
            ->where('supprimer_avenant', 0)
            ->get();

        return response()->json($avenants);
    }

    public function getInfoAvenant(Request $request)
    {
        $id_contrat = $request->all();
        $contrats = Contrat::join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->where('id_contrat', $id_contrat)
            ->first();

        return response()->json($contrats);
    }


    public function getInfo($id_contrat)
    {
        $contrats = $id_contrat;

        return response()->json($contrats);
    }

    public function editAvenant($id_avenant)
    {
        $avenants = Avenant::where('id_avenant', $id_avenant)->first();
        return response()->json($avenants);
    }

    public function deleteAvenant(Request $request)
    {
        $id_avenant = $request->id_avenant;

        $avenants = Avenant::find($id_avenant);
        $avenants->supprimer_avenant = 1;
        $avenants->save();


        $id_contrat = Avenant::where('id_avenant', $request->id_avenant)->value('id_contrat');


        if ($avenants) {

            $avenants = Avenant::select(
                'id_avenant',
                'type',
                'nom_compagnie',
                'numero_police',
                'nom_branche',
                'annee',
                'mois',
                'prime_ttc',
                'avenants.commission_courtier',
                'avenants.commission',
                'avenants.date_emission',
                'avenants.date_debut',
                'avenants.date_fin',
                'avenants.solder',
                'avenants.reverser',
            )
                ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('contrats.id_contrat', $id_contrat)
                ->where('supprimer_avenant', 0)
                ->get();

            return response()->json($avenants);
        }

        // $Data = $this->contrat->deleteAvenant($id_avenant);

        // return response()->json([
        //     'success' => true,
        //     'data' => $Data
        // ], Response::HTTP_OK);
    }

    public function postAvenant(Request $request)
    {
        // dd($request->prime_nette);
        // Obtenir l'id de la compagnie
        $getCompagnie = Contrat::select('id_compagnie')->where('id_contrat', $request->id_contrat)
            ->value("id_compagnie");

        // Obtenir l'id de la branche
        $getBranche = Contrat::select('id_branche')->where('id_contrat', $request->id_contrat)
            ->value("id_branche");

        // Obtenir l'id de l'apporteur
        $getApporteur = Contrat::select('id_apporteur')->where('id_contrat', $request->id_contrat)
            ->value("id_apporteur");

        // Obteenir le taux de la compagnie
        $tauxcomp = TauxCompagnie::select('tauxcomp')->where('id_compagnie', $getCompagnie)->where('id_branche', $getBranche)
            ->value("tauxcomp");

        // Obtenir le taux de l'apporteur
        $taux = TauxApporteur::select('taux')->where('id_apporteur', $getApporteur)->where('id_branche', $getBranche)
            ->value("taux");

        //calcul de la commision compagnie
        $comcomp =  $request->prime_nette * $tauxcomp * 0.01;

        // calcul de la commision apporteur
        $comapp =  $request->prime_nette * $tauxcomp  * 0.01 * $taux  * 0.01;


        $latestOrder = Avenant::latest()->first();

        if ($latestOrder) {
            $month = date('m');
            $year = date('Y');
            $orderNumber = intval($month) . $year . str_pad((int)substr($latestOrder->code_avenant, 4) + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $month = date('m');
            $year = date('Y');
            $orderNumber = intval($month) . $year . 0001;
        }



        $avenants = new Avenant();
        $avenants->id_contrat = $request->id_contrat;
        $avenants->annee = date("Y");
        $avenants->mois = date("m");
        $avenants->type = $request->type;
        $avenants->prime_ttc = $request->prime_ttc;
        $avenants->retrocession = $request->retrocession;
        $avenants->commission = $comapp;
        $avenants->commission_courtier = $comcomp;
        $avenants->prise_charge = $request->prise_charge;
        // $avenants->ristourne = $request->ristourne;
        $avenants->prime_nette = $request->prime_nette;
        $avenants->date_emission = Carbon::now();
        $avenants->date_debut = $request->date_debut;
        $avenants->date_fin = $request->date_fin;
        $avenants->accessoires = $request->accessoires;
        $avenants->frais_courtier = $request->frais_courtier;
        $avenants->cfga = $request->cfga;
        $avenants->taxes_totales = $request->taxes_totales;
        $avenants->id_entreprise = $request->id_entreprise;
        $avenants->user_id = $request->id;
        $avenants->code_avenant = $orderNumber;
        $avenants->save();

        if ($avenants) {

            $avenants = Avenant::select(
                'id_avenant',
                'type',
                'nom_compagnie',
                'numero_police',
                'nom_branche',
                'annee',
                'mois',
                'prime_ttc',
                'avenants.commission_courtier',
                'avenants.commission',
                'avenants.date_emission',
                'avenants.date_debut',
                'avenants.date_fin',
                'avenants.solder',
                'avenants.reverser',
            )
                ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->where('contrats.id_contrat', $request->id_contrat)
                ->where('supprimer_avenant', 0)
                ->get();

            return response()->json($avenants);
        }
    }

    public function postFileAvenant(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('file')) {
            $ressource_tmp = $request->file('file');
            if ($ressource_tmp->isValid()) {
                //obtenir l'extension de l'file
                $extension = $ressource_tmp->getClientOriginalExtension();
                //Generer un nouveau nom d'file
                $ressource = request('file')->getClientOriginalName();
                $ressourceTitle = pathinfo($ressource, PATHINFO_FILENAME);
                $ressourceName = $ressourceTitle . '.' . $extension;
                $ressourcePath = 'images/piece_avenant/';
                //charger l'image
                $ressource_tmp->move($ressourcePath, $ressourceName);
            }
        }

        $fichier = new FileAvenant();
        $fichier->nom_file = $ressourceName;
        $fichier->id_avenant = $data['id_avenant'];
        $fichier->titre = $data['titre'];
        $fichier->save();

        return response()->json($fichier);
    }

    public function getFileAvenant($id_avenant)
    {
        $files = FileAvenant::where('id_avenant', '=', $id_avenant)->get();

        return response()->json($files);
    }

    public function getInfoAvenantContrat(Request $request)
    {
        $contrats = Avenant::select(
            DB::raw("SUM(avenants.prime_nette) AS primes"),
            DB::raw("SUM(avenants.accessoires) AS accessoire"),
            DB::raw("SUM(avenants.prime_ttc) AS prime"),
            DB::raw("SUM(avenants.frais_courtier) AS frais"),
            DB::raw("SUM(avenants.taxes_totales) AS taxes"),
            DB::raw("SUM(avenants.commission_courtier) AS commission"),
            DB::raw("SUM(avenants.commission) AS commission_apporteur"),
            'apporteurs.nom_apporteur'
        )
            ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->groupBy('contrats.id_contrat')
            ->where('contrats.id_contrat', $request->contrat)
            ->first();

        return response()->json($contrats);
    }

    public function getInfoContrat(Request $request)
    {
        $infos = Contrat::join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->where('contrats.id_contrat', $request->contrat)->first();
        return response()->json($infos);
    }

    public function getCountSinistre(Request $request)
    {
        $count = Sinistre::where('id_contrat', $request->contrat)->count();
        return response()->json($count);
    }

    public function getInfosinistres(Request $request)
    {
        $sinistres = Sinistre::where('id_contrat', $request->contrat)->get();
        return response()->json($sinistres);
    }

    public function getInfoFileContrat(Request $request)
    {
        $filecontrats = Contrat::join("avenants", 'contrats.id_contrat', '=', 'avenants.id_contrat')
            ->join("file_avenants", 'avenants.id_avenant', '=', 'file_avenants.id_avenant')
            ->where('contrats.id_contrat', '=', $request->contrat)
            ->get();

        return response()->json($filecontrats);
    }

    public function getInfoFileSinistre(Request $request)
    {
        $filesinistres = Contrat::join("sinistres", 'contrats.id_contrat', '=', 'sinistres.id_contrat')
            ->join("file_sinistres", 'sinistres.id_sinistre', '=', 'file_sinistres.id_sinistre')
            ->where('contrats.id_contrat', '=', $request->contrat)
            ->get();

        return response()->json($filesinistres);
    }

    public function getInfoVehicules(Request $request)
    {
        $automobiles = Contrat::join("automobiles", 'contrats.id_contrat', '=', 'automobiles.id_contrat')
            ->where('contrats.id_contrat', '=', $request->contrat)
            ->get();

        return response()->json($automobiles);
    }

    public function postAutomobile(AutomobileRequest $request)
    {
        // Validation du formulaire
        $validated = $request->validated();

        $automobiles = new Automobile();
        $automobiles->numero_immatriculation = $request->numero_immatriculation;
        $automobiles->identification_proprietaire = $request->identification_proprietaire;
        $automobiles->date_circulation = $request->date_circulation;
        $automobiles->adresse_proprietaire = $request->adresse_proprietaire;
        $automobiles->categorie = $request->categorie_id;
        $automobiles->marque = $request->marque_id;
        $automobiles->genre = $request->genre_id;
        $automobiles->type = $request->type;
        $automobiles->carosserie = $request->carosserie;
        $automobiles->couleur = $request->couleur_id;
        $automobiles->option = $request->option;
        $automobiles->entree = $request->entree;
        $automobiles->energie = $request->energie_id;
        $automobiles->place = $request->place;
        $automobiles->puissance = $request->puissance;
        $automobiles->charge = $request->charge;
        $automobiles->valeur_neuf = $request->valeur_neuf;
        $automobiles->valeur_venale = $request->valeur_venale;
        $automobiles->categorie_socio_pro = $request->categorie_socio_pro;
        $automobiles->permis = $request->permis;
        $automobiles->prime_nette = $request->prime_nette;
        $automobiles->frais_courtier = $request->frais_courtier;
        $automobiles->accessoires = $request->accessoires;
        $automobiles->cfga = $request->cfga;
        $automobiles->taxes_totales = $request->taxes_totales;
        $automobiles->primes_ttc = $request->primes_ttc;
        $automobiles->gestion = $request->gestion;
        $automobiles->commission_apporteur = $request->commission_apporteur;
        $automobiles->commission_courtier = $request->commission_courtier;
        $automobiles->zone = $request->zone;
        $automobiles->type_garantie = $request->type_garantie;
        $automobiles->id_contrat = $request->id_contrat;
        $automobiles->save();


        if ($request->tierce != null) {
            $garanties = new Garantie();
            $garanties->nom_garantie = $request->tierce;
            $garanties->id_contrat = $request->id_contrat;
            $garanties->save();

            if ($request->garantie != null) {

                $id = Contrat::max('id_contrat');
                $ids = Garantie::max('id_garantie');
                // $ids = $garanties->id_garantie;


                $checkbox = $request->garantie;

                for ($i = 0; $i < count($checkbox); $i++) {
                    $assoc = new TypeGarantie();
                    // $assoc->id_contrat = $id;
                    $assoc->id_garantie = $ids;
                    $assoc->type_garantie = $checkbox[$i];
                    $assoc->save();
                }
            }
        }


        if ($automobiles) {
            $automobiles = Contrat::join("automobiles", 'contrats.id_contrat', '=', 'automobiles.id_contrat')
                ->where('contrats.id_contrat', '=', $request->id_contrat)
                ->get();
            return response()->json($automobiles);
        }



        return ['message' => 'Insertion avec succes'];
    }

    public function postGarantie(Request $request)
    {
        $garanties = new Garantie();
        $garanties->nom_garantie = $request->tierce;
        $garanties->id_contrat = $request->id_contrat;
        $garanties->save();

        $id = Contrat::max('id_contrat');
        $ids = Garantie::max('id_garantie');
        // $ids = $garanties->id_garantie;


        $checkbox = $request->garantie;

        for ($i = 0; $i < count($checkbox); $i++) {
            $assoc = new TypeGarantie();
            // $assoc->id_contrat = $id;
            $assoc->id_garantie = $ids;
            $assoc->type_garantie = $checkbox[$i];
            $assoc->save();
        }

        return response()->json($garanties);
    }

    public function getFileViewAvenant($id_avenant)
    {
        $documents = FileAvenant::where('id_avenant', '=', $id_avenant)->first();

        return response()->json($documents);
    }

    public function getTauxBrancheCompagnie(Request $request)
    {
        // $idbranche = Contrat::where('id_contrat', $request->contrat)->pluck('id_branche')->first();

        $tauxcompagnie = TauxCompagnie::select('tauxcomp')->where('id_compagnie', $request->compagnie)
            ->where('id_branche', $request->branche)
            ->get()->first();

        return response()->json($tauxcompagnie);
    }

    public function getTauxBrancheApporteur(Request $request)
    {
        $taux = TauxApporteur::select('taux')->where('id_apporteur', $request->apport)
            ->where('id_branche', $request->branche)
            ->get()->first();

        return response()->json($taux);
    }

    public function getViewContrat(Request $request)
    {
        $contrats = Contrat::where('id_contrat', $request->contrat)->first();

        return response()->json($contrats);
    }

    public function updateContrat(Request $request)
    {

        $id_contrat = $request->id_contrat;
        $tauxcompagnie = TauxCompagnie::select('tauxcomp')->where('id_compagnie', $request->id_compagnie)
            ->where('id_branche', $request->id_branche)
            ->value('tauxcomp');

        $tauxapporteur = TauxApporteur::select('taux')->where('id_apporteur', $request->id_apporteur)
            ->where('id_branche', $request->id_branche)
            ->value('taux');

        $commissionapporteur = $request->prime_nette * $tauxcompagnie * $tauxcompagnie * 0.01;

        $commissioncompagnie = $request->prime_nette * $tauxcompagnie * $tauxcompagnie * 0.01 * $tauxapporteur * $tauxapporteur * 0.01;

        $prime = $request->prime_nette + $request->accessoires + $request->frais_courtier + $request->taxes_totales + $request->cfga;

        Contrat::where('id_contrat', $id_contrat)->update([
            'numero_police' => request('numero_police'),
            'souscrit_le' => request('souscrit_le'),
            'effet_police' => request('effet_police'),
            'heure_police' => request('heure_police'),
            'expire_le' => request('expire_le'),
            'reconduction' => request('reconduction'),
            'id_compagnie' => request('id_compagnie'),
            'id_apporteur' => request('id_apporteur'),
            'prime_nette' => request('prime_nette'),
            'frais_courtier' => request('frais_courtier'),
            'accessoires' => request('accessoires'),
            'taxes_totales' => request('taxes_totales'),
            'primes_ttc' => $prime,
            'commission_courtier' => $commissioncompagnie,
            'gestion' => request('gestion'),
            'commission_apporteur' => $commissionapporteur,
        ]);

        // Récupérer l'id de l'avenant

        $id = Avenant::where('id_contrat', $id_contrat)->value('id_avenant');

        Avenant::where('id_avenant', $id)
            ->update([
                'prime_ttc' => $prime,  'date_debut' => request('effet_police'),
                'date_fin' => request('expire_le'), 'commission' => $commissionapporteur, 'commission_courtier' => $commissioncompagnie,
                'frais_courtier' => request('frais_courtier'), 'prime_nette' => request('prime_nette'),
                'taxes_totales' => request('taxes_totales'), 'accessoires' => request('accessoires'),
            ]);

        return response()->json($id);
    }

    public function getFactures(Request $request, $id_avenant)
    {
        $factures = Avenant::select(
            'id_avenant',
            'type',
            'nom_client',
            'adresse_client',
            'postal_client',
            'numero_client',
            'numero_police',
            'nom_compagnie',
            'nom_branche',
            'avenants.prime_nette',
            'avenants.taxes_totales',
            'date_debut',
            'date_fin',
            'code_avenant',
            DB::raw("SUM(avenants.prime_nette + avenants.accessoires + avenants.taxes_totales + avenants.frais_courtier) AS payer"),
            DB::raw("SUM(avenants.frais_courtier + avenants.accessoires) AS accessoires"),
        )
            ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->where('id_avenant', $id_avenant)
            ->groupBy('id_avenant')
            ->first();


        return response()->json($factures);
    }


    public function getContrat()
    {

        $user =  JWTAuth::parseToken()->authenticate();
        $contrats = Contrat::select('accessoires', 'cfga', 'commission_apporteur', 'commission_courtier', 'effet_police', 'expire_le', 'frais_courtier', 'gestion', 'heure_police', 'contrats.user_id as id', 'contrats.id_entreprise as id_entreprise', 'apporteurs.nom_apporteur', 'branches.nom_branche as nom_branche', 'clients.nom_client as nom_client', 'compagnies.nom_compagnie as nom_compagnie', 'clients.numero_client as numero_client', 'numero_police', 'prime_nette', 'primes_ttc', 'reconduction', 'reverse', 'solde', 'souscrit_le', 'supprimer_contrat', 'contrats.sync', 'taxes_totales', 'apporteurs.uuidApporteur as uuidApporteur', 'branches.uuidBranche as uuidBranche', 'clients.uuidClient as uuidClient', 'compagnies.uuidCompagnie as uuidCompagnie', 'contrats.uuidContrat as uuidContrat')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->where('contrats.id_entreprise', $user->id_entreprise)
            // ->where('supprimer_contrat', '=', '0')
            // ->latest('contrats.created_at')
            ->get();

        // $compagnies = $this->compagnie->getCompagnie();

        return response()->json($contrats);
    }

    public function payeAvenant(Request $request)
    {
        $avenants = Avenant::where('id_avenant', $request->id)
            ->update([
                'paye' => 'OUI',
            ]);

        if ($avenants) {
            $listescontrats = Avenant::join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
                ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
                ->join("apporteurs", 'contrats.id_apporteur', '=', 'apporteurs.id_apporteur')
                ->where('contrats.id_apporteur', $request->id_apporteur)
                ->where('supprimer_contrat', 0)
                ->get();

            $totalpaye = Avenant::join("contrats", 'contrats.id_contrat', '=', 'avenants.id_contrat')
                ->where('contrats.id_apporteur', $request->id_apporteur)
                ->where('supprimer_contrat', 0)
                ->where('paye', '=', 'OUI')
                ->sum('commission_apporteur');

            $sommepayes = round($totalpaye, 2);

            return response()->json(["listescontrats" => $listescontrats, "sommepayes" => $sommepayes]);
        }
    }

    public function getAvenants()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        // $avenants = Avenant::where('id_entreprise', $user->id_entreprise)->get();

        $avenants = Avenant::select('avenants.uuidContrat', 'annee', 'mois', 'clients.nom_client', 'branches.nom_branche', 'compagnies.nom_compagnie', 'contrats.numero_police', 'avenants.prime_ttc', 'avenants.retrocession', 'avenants.commission', 'avenants.commission_courtier', 'avenants.prise_charge', 'avenants.ristourne', 'avenants.prime_nette', 'date_emission', 'date_debut', 'date_fin', 'avenants.accessoires', 'avenants.frais_courtier', 'avenants.cfga', 'avenants.taxes_totales', 'code_avenant', 'uuidAvenant', 'avenants.uuidApporteur', 'avenants.uuidCompagnie', 'solder', 'reverser', 'payer_apporteur', 'payer_courtier', 'supprimer_avenant', 'avenants.id_entreprise', 'avenants.sync')
            ->join("contrats", 'avenants.id_contrat', '=', 'contrats.id_contrat')
            ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
            ->join("branches", 'contrats.id_branche', '=', 'branches.id_branche')
            ->join("compagnies", 'contrats.id_compagnie', '=', 'compagnies.id_compagnie')
            ->where('avenants.id_entreprise', $user->id_entreprise)
            // ->where('supprimer_sinistre', '=', '0')
            // ->latest('sinistres.created_at')
            ->get();

        return response()->json($avenants);
    }

    public function getAutomobiles()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $automobiles = Automobile::select('uuidAutomobile', 'automobiles.uuidContrat', 'numero_immatriculation', 'date_circulation', 'identification_proprietaire', 'adresse_proprietaire', 'zone', 'categorie', 'marque', 'genre', 'type', 'carosserie', 'couleur', 'energie', 'place', 'puissance', 'charge', 'valeur_neuf', 'valeur_venale', 'categorie_socio_pro', 'permis', 'option', 'entree', 'automobiles.prime_nette', 'automobiles.accessoires', 'automobiles.frais_courtier', 'automobiles.cfga', 'automobiles.taxes_totales', 'automobiles.commission_courtier', 'automobiles.commission_apporteur', 'automobiles.gestion', 'automobiles.primes_ttc', 'automobiles.sync', 'automobiles.id_entreprise')
            ->join("contrats", 'automobiles.id_contrat', '=', 'contrats.id_contrat')
            ->where('automobiles.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($automobiles);
    }

    public function getGaranties()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $garanties = Garantie::select('uuidGarantie', 'garanties.uuidAutomobile', 'garanties.id_automobile', 'nom_garantie', 'automobiles.sync')
            ->join("automobiles", 'garanties.id_automobile', '=', 'automobiles.id_automobile')
            ->where('garanties.id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($garanties);
    }
}
