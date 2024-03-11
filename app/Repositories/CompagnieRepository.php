<?php

namespace App\Repositories;

use App\Models\Branche;
use App\Models\Compagnie;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\Auth;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CompagnieRepository.
 */
class CompagnieRepository extends BaseRepository
{
    protected $compagnies;

    public function __construct(Compagnie $compagnies)
    {
        $this->compagnies = $compagnies;
    }
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        //return YourModel::class;
    }

    public function postCompagnie(array $data)
    {
        // try {
        $compagnie = $data['nom_compagnie'];
        if (Compagnie::where('nom_compagnie', '=', $compagnie)->count() > 0) {
            return response()->json(['message' => 'Apporteur existant'], 422);
        } else {
            $length = 12;
            // $token = bin2hex(random_bytes($length));

            $all = $data;
            $compagnies = new Compagnie();
            $compagnies->nom_compagnie = $data['nom_compagnie'];
            $compagnies->contact_compagnie = $data['contact_compagnie'];
            $compagnies->email_compagnie = $data['email_compagnie'];
            $compagnies->adresse_compagnie = $data['adresse_compagnie'];
            $compagnies->code_compagnie = $data['code_compagnie'];
            $compagnies->id_entreprise =   $data['id_entreprise'];
            $compagnies->uuidCompagnie =  $data['uuidCompagnie'];
            $compagnies->user_id =  $data['id'];
            $compagnies->sync =  1;
            $compagnies->save();

            // $id = $compagnies['id_compagnie'];
            $uuidCompagnie = $compagnies['uuidCompagnie'];

            $leads = $all['accidents'];  // valeur
            $id = $all['ids']; // id

            $branches = Branche::whereIn('uuidBranche', $id)->get();
            $firsts = [];

            foreach ($branches as $branche) {
                $idBranche = $branche->id_branche;
                $firsts[] = $idBranche;
            }

            $array = array_combine($firsts, $leads);

            foreach ($array as $key => $value) {
                $taux = new TauxCompagnie();
                $taux->tauxcomp = $value;
                $taux->id_branche = $key;
                $taux->id_compagnie = $compagnies['id_compagnie'];
                $taux->uuidCompagnie = $compagnies['uuidCompagnie'];
                $taux->sync = 1;
                $taux->save();
            }

            return $compagnies;
        }
        // } catch (\Exception $exception){
        //     die("Could not connect to the database.  Please check your configuration. error:" . $exception );
        //     return response()->json(['message' => 'Client non enregistré'], 422);
        // }
    }

    public function deleteCompagnie(int $id_compagnie)
    {
        $compagnies = Compagnie::find($id_compagnie);
        $compagnies->supprimer_compagnie = 1;
        $compagnies->save();

        return $compagnies;
    }

    public function editTauxCompagnie($id_tauxcomp)
    {
        return TauxCompagnie::where('id_tauxcomp', $id_tauxcomp)->first();
    }


    public function updateCompagnie(int $id_compagnie)
    {
        $compagnie = Compagnie::find($id_compagnie);
        $compagnie->nom_compagnie = request('nom_compagnie');
        $compagnie->email_compagnie = request('email_compagnie');
        $compagnie->contact_compagnie = request('contact_compagnie');
        $compagnie->adresse_compagnie = request('adresse_compagnie');
        $compagnie->save();

        return $compagnie;
    }

    public function postTauxCompagnie(array $data)
    {

        $id_apporteur = Compagnie::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('nom_compagnie', $data['name'])->pluck('id_compagnie')->first();

        $leads = $data['accidents'];  // valeur
        $firsts = $data['ids']; // id

        $array = array_combine($firsts, $leads);

        foreach ($array as $key => $value) {
            $taux = new TauxCompagnie();
            $taux->tauxcomp = $value;
            $taux->id_branche = $key;
            $taux->id_compagnie = $id_apporteur;
            $taux->save();
        }

        return $id_apporteur;
    }

    public function updateTauxCompagnie(array $data)
    {
        $id_tauxcomp  = $data['id_tauxcomp'];
        $tauxcomp = $data['tauxcomp'];
        $compagnies = TauxCompagnie::where('id_tauxcomp', $id_tauxcomp)->update(['tauxcomp' => $tauxcomp]);

        return $compagnies;
    }

    public function getCompagnie()
    {
        $compagnies = Compagnie::where('id_entreprise', Auth::user()->id_entreprise)
            ->where('supprimer_compagnie', '=', '0')
            ->get();

        return $compagnies;
    }
}
