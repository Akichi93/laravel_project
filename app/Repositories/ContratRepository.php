<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Avenant;
use App\Models\Branche;
use App\Models\Contrat;
use App\Models\Garantie;
use App\Models\Sinistre;
use App\Models\Automobile;
use App\Models\TypeGarantie;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ContratRepository.
 */
class ContratRepository extends BaseRepository
{
    protected $contrats;

    public function __construct(Contrat $contrats)
    {
        $this->contrats = $contrats;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function postContrat(array $data)
    {
        // try {

        $contrats = new Contrat();
        $contrats->id_branche = $data['id_branche'];
        $contrats->id_client = $data['id_client'];
        $contrats->id_compagnie = $data['id_compagnie'];
        $contrats->id_apporteur = $data['id_apporteur'];
        $contrats->numero_police = $data['numero_police'];
        $contrats->souscrit_le = $data['souscrit_le'];
        $contrats->effet_police = $data['effet_police'];
        $contrats->heure_police = $data['heure_police'];
        $contrats->expire_le = $data['expire_le'];
        $contrats->reconduction = $data['reconduction'];
        $contrats->prime_nette = $data['prime_nette'];
        $contrats->frais_courtier = $data['frais_courtier'];
        $contrats->accessoires = $data['accessoires'];
        $contrats->cfga = $data['cfga'];
        $contrats->taxes_totales = $data['taxes_totales'];
        $contrats->primes_ttc = $data['primes_ttc'];
        $contrats->gestion = $data['gestion'];
        $contrats->commission_apporteur = $data['commission_apporteur'];
        $contrats->commission_courtier = $data['commission_courtier'];
        $contrats->id_entreprise = Auth::user()->id_entreprise;
        $contrats->user_id = Auth::user()->id;
        $contrats->save();

        $id = $contrats['id_contrat'];

        $avenants = new Avenant();
        $avenants->id_contrat = $id;
        $avenants->annee = Carbon::createFromFormat('Y-m-d', $data['souscrit_le'])->format('Y');
        $avenants->mois = Carbon::createFromFormat('Y-m-d', $data['souscrit_le'])->format('m');
        $avenants->type = "Affaire Nouvelle";
        $avenants->prime_ttc = $data['primes_ttc'];
        $avenants->retrocession = $data['retrocession'];
        $avenants->commission = $data['commission_apporteur'];
        $avenants->commission_courtier = $data['commission_courtier'];
        $avenants->prise_charge = $data['prise_charge'];
        $avenants->ristourne = $data['ristourne'];
        $avenants->prime_nette = $data['prime_nette'];
        $avenants->date_emission = $data['souscrit_le'];
        $avenants->date_debut = $data['effet_police'];
        $avenants->date_fin = $data['expire_le'];
        $avenants->accessoires = $data['accessoires'];
        $avenants->frais_courtier = $data['frais_courtier'];
        $avenants->cfga = $data['cfga'];
        $avenants->taxes_totales = $data['taxes_totales'];
        $avenants->id_entreprise = Auth::user()->id_entreprise;
        $avenants->user_id = Auth::user()->id;
        $avenants->save();

        // Obtenir le nom de la branche
        $branche = Branche::select('nom_branche')->where('id_branche', $data['id_branche'])->value("nom_branche");


        if ($branche == "AUTOMOBILE" || $branche == "MOTO") {
            //Ajout d'autombile
            $autos = new Automobile();
            $autos->numero_immatriculation = $data['numero_immatriculation'];
            $autos->identification_proprietaire = $data['identification_proprietaire'];
            $autos->date_circulation = $data['date_circulation'];
            $autos->adresse_proprietaire = $data['adresse_proprietaire'];
            $autos->categorie = $data['categorie_id'];
            $autos->marque = $data['marque_id'];
            $autos->genre = $data['genre_id'];
            $autos->type = $data['type'];
            $autos->carosserie = $data['carosserie'];
            $autos->couleur = $data['couleur_id'];
            $autos->option = $data['option'];
            $autos->entree = $data['entree'];
            $autos->energie = $data['energie_id'];
            $autos->place = $data['place'];
            $autos->puissance = $data['puissance'];
            $autos->charge = $data['charge'];
            $autos->valeur_neuf = $data['valeur_neuf'];
            $autos->valeur_venale = $data['valeur_venale'];
            $autos->categorie_socio_pro = $data['categorie_socio_pro'];
            $autos->permis = $data['permis'];
            $autos->prime_nette = $data['prime_nette'];
            $autos->frais_courtier = $data['frais_courtier'];
            $autos->accessoires = $data['accessoires'];
            $autos->cfga = $data['cfga'];
            $autos->taxes_totales = $data['taxes_totales'];
            $autos->primes_ttc = $data['primes_ttc'];
            $autos->gestion = $data['gestion'];
            $autos->commission_apporteur = $data['commission_apporteur'];
            $autos->commission_courtier = $data['commission_courtier'];
            $autos->zone = $data['zone'];
            $autos->type_garantie = $data['type_garantie'];
            $autos->id_contrat = $id;
            $autos->save();

            if ($data['nom_garantie'] != null) {
                $garanties = new Garantie();
                $garanties->nom_garantie = $data['tierce'];
                $garanties->id_contrat = $id;
                $garanties->save();

                $id = Contrat::max('id_contrat');
                $ids = Garantie::max('id_garantie');
                // $ids = $garanties->id_garantie;


                $checkbox = $data['garantie'];

                for ($i = 0; $i < count($checkbox); $i++) {
                    $assoc = new TypeGarantie();
                    // $assoc->id_contrat = $id;
                    $assoc->id_garantie = $ids;
                    $assoc->type_garantie = $checkbox[$i];
                    $assoc->save();
                }
            }
        }


        return ['message' => 'Insertion avec succes'];
        // } catch (\Exception $exception) {
        //     die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
        //     return response()->json(['message' => 'Contrat non enregistré'], 422);
        // }
    }

    public function deleteContrat(int $id_contrat)
    {
        $contrats = Contrat::find($id_contrat);
        $contrats->supprimer_contrat = 1;
        $contrats->save();

        // Supprimer avenants

        $updateAvenant = Avenant::where('id_contrat',$id_contrat)->update(['supprimer_avenant' => 1]);

        // Supprimer sinistre

        $updateSinistre = Sinistre::where('id_contrat',$id_contrat)->update(['supprimer_sinistre' => 1]);

        return $contrats;
    }

    public function soldeContrat($id)
    {
        $contrats = Contrat::where('id_contrat', $id)->update([
            'solde' => 1,
        ]);

        return $contrats;
    }

    public function soldeAvenant($id)
    {
        $contrats = Avenant::where('id_avenant', $id)->update([
            'solder' => 1,
        ]);

        return $contrats;
    }

    public function reverseContrat($id)
    {
        $contrats = Contrat::where('id_contrat', $id)->update([
            'reverse' => 1,
        ]);

        return $contrats;
    }

    public function reverseAvenant($id)
    {
        $contrats = Avenant::where('id_avenant', $id)->update([
            'reverser' => 1,
        ]);

        return $contrats;
    }

    public function deleteAvenant(int $id_avenant)
    {
        $avenants = Avenant::find($id_avenant);
        $avenants->supprimer_avenant = 1;
        $avenants->save();

        return $avenants;
    }
}
