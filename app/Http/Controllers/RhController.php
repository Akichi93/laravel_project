<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\Depense;
use App\Models\Secteur;
use App\Models\TypeDepense;
use Illuminate\Http\Request;

class RhController extends Controller
{
    public function listeSalaire()
    {
        $salaries = Salary::where('id_entreprise', Auth::user()->id_entreprise)->get();

        return response()->json($salaries);
    }

    public function postSalaire(Request $request)
    {
        $salaries = new Salary();
        $salaries->nom = $request->nom;
        $salaries->prenom = $request->prenom;
        $salaries->sexe = $request->sexe;
        $salaries->renumeration = $request->renumeration;
        $salaries->date_naissance = $request->date_naissance;
        $salaries->date_embauche = $request->date_embauche;
        $salaries->secteur = $request->secteur;
        $salaries->id_entreprise = Auth::user()->id_entreprise;
        $salaries->user_id = Auth::user()->id;
        $salaries->save();
        return response()->json($salaries);
    }

    public function salairemoyen()
    {
        $salaire = Salary::sum('renumeration');
        $nbre = Salary::count();

        if ($nbre == 0) {
            $moyen = 0;
        } else {
            $moyen = $salaire / $nbre;
        }



        return response()->json($moyen);
    }

    public function nbresalaire()
    {
        $nbre = Salary::count();

        return response()->json($nbre);
    }

    public function massesalariale()
    {
        $masse = Salary::sum('renumeration');

        return response()->json($masse);
    }

    public function listeDepenses()
    {
        $expenditures = Depense::join("categorie_depenses", 'depenses.id_catdep', '=', 'categorie_depenses.id_catdep')
            ->join("type_depenses", 'depenses.id_typedep', '=', 'type_depenses.id_typedep')
            ->where('depenses.id_entreprise', Auth::user()->id_entreprise)
            ->orderBy('id_depense', 'DESC')
            ->get();

        return response()->json($expenditures);
    }

    public function postDepense(Request $request)
    {
        $depenses = new Depense();
        $depenses->id_catdep = $request->id_catdep;
        $depenses->id_typedep = $request->type_id;
        $depenses->date_operation = $request->date_operation;
        $depenses->montant = $request->montant;
        $depenses->info_depense = $request->libelles;
        $depenses->id_entreprise = Auth::user()->id_entreprise;
        $depenses->user_id = Auth::user()->id;
        $depenses->save();
        return response()->json($depenses);
    }

    public function listeTypeDepense()
    {
        $expenses = TypeDepense::where('id_entreprise', Auth::user()->id_entreprise)->get();

        return response()->json($expenses);
    }

    public function postTypeDepense(Request $request)
    {
        $type = $request->nom_type;
        if (TypeDepense::where('nom_type', '=', $type)->where('id_entreprise', Auth::user()->id_entreprise)->count() > 0) {
            return response()->json(['message' => 'Type existant'], 422);
        }

        $types = new TypeDepense();
        $types->nom_type = $request->nom_type;
        $types->id_entreprise = Auth::user()->id_entreprise;
        $types->user_id = Auth::user()->id;
        $types->save();
        return response()->json($types);
    }

    public function listeSecteurs()
    {
        $secteurs = Secteur::all();

        return response()->json($secteurs);
    }
}
