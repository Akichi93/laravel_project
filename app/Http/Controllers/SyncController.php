<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Genre;
use App\Models\Client;
use App\Models\Marque;
use App\Models\Avenant;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Garantie;
use App\Models\Prospect;
use App\Models\Sinistre;
use App\Models\Apporteur;
use App\Models\Categorie;
use App\Models\Compagnie;
use App\Models\Reglement;
use App\Models\Automobile;
use App\Models\Couleur;
use App\Models\Energie;
use Illuminate\Http\Request;
use App\Models\TauxApporteur;
use App\Models\TauxCompagnie;
use Tymon\JWTAuth\Facades\JWTAuth;

class SyncController extends Controller
{

    public function syncBranche(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        // Création de l'enregistrement avec la méthode create
        $branche = Branche::create($data);

        // Mise à jour de la valeur de sync à 1
        $branche->update(['sync' => 1]);

        if ($branche) {
            $branches = Branche::where('id_entreprise', $data['id_entreprise'])->get();

            return response()->json($branches);
        }
    }

    public function syncProspect(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $prospectData) {
            // Use updateOrCreate to create or update the Client model
            Prospect::updateOrCreate(
                ['uuidProspect' => $prospectData['uuidProspect']], // Unique identifier
                [
                    'sync' => 1,
                    'id_entreprise' => $prospectData['id_entreprise'],
                    'nom_prospect' => $prospectData['nom_prospect'],
                    'adresse_prospect' => $prospectData['adresse_prospect'],
                    'postal_prospect' => $prospectData['postal_prospect'],
                    'profession_prospect' => $prospectData['profession_prospect'],
                    'tel_prospect' => $prospectData['tel_prospect'],
                    'civilite' => $prospectData['civilite'],
                    'email_prospect' => $prospectData['email_prospect'],
                    'fax_prospect' => $prospectData['fax_prospect'],
                    'user_id' => $prospectData['id'],
                    'statut' => $prospectData['statut'],
                    'etat' => $prospectData['etat'],
                ]
            );
        }
    }


    public function syncClient(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $clientData) {
            // Use updateOrCreate to create or update the Client model
            Client::updateOrCreate(
                ['uuidClient' => $clientData['uuidClient']], // Unique identifier
                [
                    'sync' => 1,
                    'id_entreprise' => $clientData['id_entreprise'],
                    'numero_client' => $clientData['numero_client'],
                    'nom_client' => $clientData['nom_client'],
                    'adresse_client' => $clientData['adresse_client'],
                    'postal_client' => $clientData['postal_client'],
                    'profession_client' => $clientData['profession_client'],
                    'tel_client' => $clientData['tel_client'],
                    'civilite' => $clientData['civilite'],
                    'email_client' => $clientData['email_client'],
                    'fax_client' => $clientData['fax_client'],
                    'user_id' => $clientData['user_id'],
                ]
            );
        }
    }




    public function syncCompagnie(Request $request)
    {
        // Recuperer user
        // $user =  JWTAuth::parseToken()->authenticate();
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $compagnieData) {
            // Use updateOrCreate to create or update the Client model
            Compagnie::updateOrCreate(
                ['uuidCompagnie' => $compagnieData['uuidCompagnie']], // Unique identifier
                [
                    'sync' => 1,
                    'id_entreprise' => $compagnieData['id_entreprise'],
                    'nom_compagnie' => $compagnieData['nom_compagnie'],
                    'adresse_compagnie' => $compagnieData['adresse_compagnie'],
                    'email_compagnie' => $compagnieData['email_compagnie'],
                    'contact_compagnie' => $compagnieData['contact_compagnie'],
                    'postal_compagnie' => $compagnieData['postal_compagnie'],
                    'code_compagnie' => $compagnieData['code_compagnie'],
                    'supprimer_compagnie' => $compagnieData['supprimer_compagnie'],
                    'user_id' => $compagnieData['user_id'],
                ]
            );
        }
    }

    public function syncTauxCompagnie(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $tauxcompagnieData) {
            $branche = Branche::where('uuidBranche', $tauxcompagnieData['uuidBranche'])->first();
            $compagnie = Compagnie::where('uuidCompagnie', $tauxcompagnieData['uuidCompagnie'])->first();

            // Use updateOrCreate to create or update the Client model
            TauxCompagnie::updateOrCreate(
                ['uuidTauxCompagnie' => $tauxcompagnieData['uuidTauxCompagnie']], // Unique identifier
                [
                    'sync' => 1,
                    'uuidCompagnie' => $tauxcompagnieData['uuidCompagnie'],
                    'tauxcomp' => $tauxcompagnieData['tauxcomp'],
                    'uuidBranche' => $tauxcompagnieData['uuidBranche'],
                    'id_branche' => $branche['id_branche'],
                    'id_compagnie' => $compagnie['id_compagnie'],
                    'id_entreprise' => $tauxcompagnieData['id_entreprise'],
                ]
            );
        }
    }

    public function syncApporteur(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $apporteurData) {
            // Use updateOrCreate to create or update the Client model
            Apporteur::updateOrCreate(
                ['uuidApporteur' => $apporteurData['uuidApporteur']], // Unique identifier
                [
                    'sync' => 1,
                    'id_entreprise' => $apporteurData['id_entreprise'],
                    'nom_apporteur' => $apporteurData['nom_apporteur'],
                    'email_apporteur' => $apporteurData['email_apporteur'],
                    'adresse_apporteur' => $apporteurData['adresse_apporteur'],
                    'contact_apporteur' => $apporteurData['contact_apporteur'],
                    'code_apporteur' => $apporteurData['code_apporteur'],
                    'code_postal' => $apporteurData['code_postal'],
                    'supprimer_apporteur' => $apporteurData['supprimer_apporteur'],
                    'user_id' => $apporteurData['id'],
                ]
            );
        }
    }

    public function syncTauxApporteur(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $tauxapporteureData) {
            $branche = Branche::where('uuidBranche', $tauxapporteureData['uuidBranche'])->first();
            $apporteur = Apporteur::where('uuidApporteur', $tauxapporteureData['uuidApporteur'])->first();
            // Use updateOrCreate to create or update the Client model
            TauxApporteur::updateOrCreate(
                ['uuidTauxApporteur' => $tauxapporteureData['uuidTauxApporteur']], // Unique identifier
                [
                    'sync' => 1,
                    'uuidApporteur' => $tauxapporteureData['uuidApporteur'],
                    'taux' => $tauxapporteureData['taux'],
                    'uuidBranche' => $tauxapporteureData['uuidBranche'],
                    'id_branche' => $branche['id_branche'],
                    'id_apporteur' => $apporteur['id_apporteur'],
                    'id_entreprise' => $tauxapporteureData['id_entreprise'],
                ]
            ); 
        }
    }

    public function syncContrat(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $contratData) {
            $compagnie = Compagnie::where('uuidCompagnie', $contratData['uuidCompagnie'])->first();
            $apporteur = Apporteur::where('uuidApporteur', $contratData['uuidApporteur'])->first();
            $client = Client::where('uuidClient', $contratData['uuidClient'])->first();
            $branche = Branche::where('uuidBranche', $contratData['uuidBranche'])->first();
            // Utilisation de updateOrCreate pour créer ou mettre à jour le modèle Contrat
            Contrat::updateOrCreate(
                ['uuidContrat' => $contratData['uuidContrat']], // Identifiant unique
                [
                    'sync' => 1,
                    'id_branche' => $branche['id_branche'],
                    'id_client' => $client['id_client'],
                    'id_compagnie' => $compagnie['id_compagnie'],
                    'id_apporteur' => $apporteur['id_apporteur'],
                    'numero_police' => $contratData['numero_police'],
                    'souscrit_le' => $contratData['souscrit_le'],
                    'effet_police' => $contratData['effet_police'],
                    'heure_police' => $contratData['heure_police'],
                    'expire_le' => $contratData['expire_le'],
                    'reconduction' => $contratData['reconduction'],
                    'prime_nette' => $contratData['prime_nette'],
                    'accessoires' => $contratData['accessoires'],
                    'cfga' => $contratData['cfga'],
                    'taxes_totales' => $contratData['taxes_totales'],
                    'primes_ttc' => $contratData['primes_ttc'],
                    'commission_courtier' => $contratData['commission_courtier'],
                    'gestion' => $contratData['gestion'],
                    'commission_apporteur' => $contratData['commission_apporteur'],
                    'solde' => $contratData['solde'],
                    'reverse' => $contratData['reverse'],
                    'user_id' => $contratData['id'],
                    'supprimer_contrat' => $contratData['supprimer_contrat'],
                    'id_entreprise' => $contratData['id_entreprise'],
                    'frais_courtier' => $contratData['frais_courtier'],
                ]
            );
        }
    }

    public function syncAvenant(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $AvenantData) {
            $contrat = Contrat::where('uuidContrat', $AvenantData['uuidContrat'])->first();
            // Use updateOrCreate to create or update the Client model
            Avenant::updateOrCreate(
                ['uuidAvenant' => $AvenantData['uuidAvenant']], // Unique identifier
                [
                    'sync' => 1,
                    // 'uuidAvenant' => $AvenantData['uuidAvenant'],
                    'uuidContrat' => $AvenantData['uuidContrat'],
                    'id_contrat' => $contrat['id_contrat'],
                    'uuidCompagnie' => $AvenantData['uuidCompagnie'],
                    'uuidApporteur' => $AvenantData['uuidApporteur'],
                    'annee' => $AvenantData['annee'],
                    'mois' => $AvenantData['mois'],
                    'type' => $AvenantData['type'],
                    'prime_ttc' => $AvenantData['prime_ttc'],
                    'retrocession' => $AvenantData['retrocession'],
                    'commission' => $AvenantData['commission'],
                    'commission_courtier' => $AvenantData['commission_courtier'],
                    'prise_charge' => $AvenantData['prise_charge'],
                    'ristourne' => $AvenantData['ristourne'],
                    'prime_nette' => $AvenantData['prime_nette'],
                    'date_emission' => $AvenantData['date_emission'],
                    'date_debut' => $AvenantData['date_debut'],
                    'date_fin' => $AvenantData['date_fin'],
                    'accessoires' => $AvenantData['accessoires'],
                    'frais_courtier' => $AvenantData['frais_courtier'],
                    'cfga' => $AvenantData['cfga'],
                    'taxes_totales' => $AvenantData['taxes_totales'],
                    'id_entreprise' => $AvenantData['id_entreprise'],
                    'payer_courtier' => $AvenantData['payer_courtier'],
                    'payer_apporteur' => $AvenantData['payer_apporteur'],
                    'user_id' => $AvenantData['id'],
                    'supprimer_avenant' => $AvenantData['supprimer_avenant'],
                    'code_avenant' => $AvenantData['code_avenant'],
                    'solder' => $AvenantData['solder'],
                    'reverser' => $AvenantData['reverser'],
                ]
            );
        }
    }

    public function syncAutomobile(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $AutomobileData) {
            $contrat = Contrat::where('uuidContrat', $AutomobileData['uuidContrat'])->first();
            // Use updateOrCreate to create or update the Client model
            Automobile::updateOrCreate(
                ['uuidAutomobile' => $AutomobileData['uuidAutomobile']], // Unique identifier
                [
                    'sync' => 1,
                    //   'uuidAutomobile' => $AutomobileData['uuidAutomobile'],
                    'uuidContrat' => $AutomobileData['uuidContrat'],
                    'numero_immatriculation' => $AutomobileData['numero_immatriculation'],
                    'date_circulation' => $AutomobileData['date_circulation'],
                    'date_circulation' => $AutomobileData['date_circulation'],
                    'categorie' => $AutomobileData['categorie'],
                    'marque' => $AutomobileData['marque'],
                    'genre' => $AutomobileData['genre'],
                    'type' => $AutomobileData['type'],
                    'carosserie' => $AutomobileData['carosserie'],
                    'couleur' => $AutomobileData['couleur'],
                    // 'option' => $AutomobileData['option'],
                    'entree' => $AutomobileData['entree'],
                    'energie' => $AutomobileData['energie'],
                    'place' => $AutomobileData['place'],
                    'puissance' => $AutomobileData['puissance'],
                    'charge' => $AutomobileData['charge'],
                    'valeur_neuf' => $AutomobileData['valeur_neuf'],
                    'valeur_venale' => $AutomobileData['valeur_venale'],
                    'categorie_socio_pro' => $AutomobileData['categorie_socio_pro'],
                    'permis' => $AutomobileData['permis'],
                    // 'prime_nette' => $AutomobileData['prime_nette'],
                    // 'frais_courtier' => $AutomobileData['frais_courtier'],
                    // 'accesoires' => $AutomobileData['accesoires'],
                    // 'cfga' => $AutomobileData['cfga'],
                    // 'taxes_totales' => $AutomobileData['taxes_totales'],
                    // 'prime_ttc' => $AutomobileData['prime_ttc'],
                    // 'commission_courtier' => $AutomobileData['commission_courtier'],
                    // 'gestion' => $AutomobileData['gestion'],
                    // 'commission_apporteur' => $AutomobileData['commission_apporteur'],
                    // 'type_garantie' => $AutomobileData['type_garantie'],
                    'zone' => $AutomobileData['zone'],
                    'id_contrat' => $contrat['id_contrat'],
                    'id_entreprise' => $AutomobileData['id_entreprise'],
                ]
            );
        }
    }

    public function syncGarantie(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $garantieData) {
            $auto = Automobile::where('uuidAutomobile', $garantieData['uuidAutomobile'])->first();


            Garantie::updateOrCreate(
                ['uuidGarantie' => $garantieData['uuidGarantie']],
                [
                    'sync' => 1,
                    'uuidAutomobile' => $garantieData['uuidAutomobile'],
                    'nom_garantie' => $garantieData['nom_garantie'],
                    'id_automobile' => $auto['id_automobile'],
                    'id_entreprise' => $garantieData['id_entreprise'],
                ]
            );
        }
    }

    public function syncSinistre(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $sinistreData) {
            $contrat = Contrat::where('uuidContrat', $sinistreData['uuidContrat'])->first();


            Sinistre::updateOrCreate(
                ['uuidSinistre' => $sinistreData['uuidSinistre']],
                [
                    'sync' => 1,
                    'id_contrat' => $contrat['id_contrat'],
                    'date_survenance' => $sinistreData['date_survenance'],
                    'heure' => $sinistreData['heure'],
                    'date_ouverture' => $sinistreData['date_ouverture'],
                    'date_decla_compagnie' => $sinistreData['date_decla_compagnie'],
                    'numero_sinistre' => $sinistreData['numero_sinistre'],
                    'reference_compagnie' => $sinistreData['reference_compagnie'],
                    'gestion_compagnie' => $sinistreData['gestion_compagnie'],
                    'materiel_sinistre' => $sinistreData['materiel_sinistre'],
                    'ipp' => $sinistreData['ipp'],
                    'garantie_applique' => $sinistreData['garantie_applique'],
                    'recours_sinistre' => $sinistreData['recours_sinistre'],
                    'date_mission' => $sinistreData['date_mission'],
                    'accident_sinistre' => $sinistreData['accident_sinistre'],
                    'lieu_sinistre' => $sinistreData['lieu_sinistre'],
                    'expert' => $sinistreData['expert'],
                    'commentaire_sinistre' => $sinistreData['commentaire_sinistre'],
                    'etat' => $sinistreData['etat'],
                    'id_entreprise' => $sinistreData['id_entreprise'],
                    'user_id' => $sinistreData['user_id'],
                    'supprimer_sinistre' => $sinistreData['supprimer_sinistre'],
                ]
            );
        }
    }

    public function syncReglement(Request $request)
    {
        $data = $request->all();

        foreach ($data as $sinistreData) {
            $sinistre = Sinistre::where('uuidContrat', $sinistreData['uuidContrat'])->first();


            Reglement::updateOrCreate(
                ['uuidReglement' => $sinistreData['uuidReglement']],
                [
                    'sync' => 1,
                    'id_sinistre' => $sinistre['id_sinistre'],
                    'type_reglement' => $sinistreData['type_reglement'],
                    'nom' => $sinistreData['nom'],
                    'mode' => $sinistreData['mode'],
                    'montant' => $sinistreData['montant'],
                    'date_reglement' => $sinistreData['numero_sinistre'],
                    'user_id' => $sinistreData['user_id'],
                    'supprimer_reglement' => $sinistreData['supprimer_reglement'],
                    'id_entreprise' => $sinistreData['id_entreprise'],
                ]
            );
        }
    }

    public function syncCategorie(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $categorieData) {
            // Use updateOrCreate to create or update the Client model
            Categorie::updateOrCreate(
                ['uuidCategorie' => $categorieData['uuidCategorie']], // Unique identifier
                [
                    'sync' => 1,
                    'categorie' => $categorieData['categorie'],
                ]
            );
        }
    }

    public function syncMarque(Request $request)
    {
        // Données à synchroniser
        $data = $request->all();

        foreach ($data as $marqueData) {
            // Use updateOrCreate to create or update the Client model
            Marque::updateOrCreate(
                ['uuidMarque' => $marqueData['uuidMarque']], // Unique identifier
                [
                    'sync' => 1,
                    'marque' => $marqueData['marque'],
                ]
            );
        }
    }

    public function syncGenre(Request $request)
    {
         // Données à synchroniser
         $data = $request->all();

         foreach ($data as $genreData) {
             // Use updateOrCreate to create or update the Client model
             Genre::updateOrCreate(
                 ['uuidGenre' => $genreData['uuidGenre']], // Unique identifier
                 [
                     'sync' => 1,
                     'genre' => $genreData['genre'],
                 ]
             );
         }
    }

    public function syncCouleur(Request $request)
    {
         // Données à synchroniser
         $data = $request->all();

         foreach ($data as $couleurData) {
             // Use updateOrCreate to create or update the Client model
             Couleur::updateOrCreate(
                 ['uuidCouleur' => $couleurData['uuidCouleur']], // Unique identifier
                 [
                     'sync' => 1,
                     'couleur' => $couleurData['couleur'],
                 ]
             );
         }
    }

    public function syncEnergie(Request $request)
    {
         // Données à synchroniser
         $data = $request->all();

         foreach ($data as $energieData) {
             // Use updateOrCreate to create or update the Client model
             Energie::updateOrCreate(
                 ['uuidEnergie' => $energieData['uuidEnergie']], // Unique identifier
                 [
                     'sync' => 1,
                     'energie' => $energieData['energie'],
                 ]
             );
         }
    }
}
