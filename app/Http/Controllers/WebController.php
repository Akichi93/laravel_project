<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Client;
use App\Models\Salary;
use App\Models\Contrat;
use App\Models\Depense;
use App\Models\Sinistre;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function modulerh()
    {
        $superadmin = User::join("roles", 'roles.id_role', '=', 'users.id_role')
            ->where('id_entreprise', Auth::user()->id_entreprise)
            ->where('users.id', Auth::user()->id)
            ->where('nom_role', 'SUPERADMIN')
            ->count();

        $admin = User::join("roles", 'roles.id_role', '=', 'users.id_role')
            ->where('id_entreprise', Auth::user()->id_entreprise)
            ->where('users.id', Auth::user()->id)
            ->where('nom_role', 'ADMIN')
            ->count();

        return view('module.rh', compact('superadmin', 'admin'));
    }

    public function modulecourtage()
    {
        return view('module.courtage');
    }

    public function modulestat()
    {
        $data['users'] = User::where('id_entreprise', Auth::user()->id_entreprise)->count();
        $data['clients'] = Client::where('id_entreprise', Auth::user()->id_entreprise)->count();
        $data['contrats'] = Contrat::where('id_entreprise', Auth::user()->id_entreprise)->count();
        $data['sinistres'] = Sinistre::where('id_entreprise', Auth::user()->id_entreprise)->count();
        $data['depenses'] = Depense::where('id_entreprise', Auth::user()->id_entreprise)->count();
        $data['salaires'] = Salary::where('id_entreprise', Auth::user()->id_entreprise)->count();
        return view('module.stat', $data);
    }

    public function typedepenses()
    {
        return view('categories.typesdepenses');
    }

    public function categoriestypes()
    {
        return view('categories.categoriestypes');
    }

    public function salary()
    {
        return view('salarie.salarie');
    }

    public function createsalary()
    {
        return view('salarie.createsalarie');
    }

    public function addreglement()
    {
        return view('sinistre.ajoutreg');
    }

    public function uploads()
    {
        return view('parametre.upload');
    }

    public function relance()
    {
        return view('customer.relance');
    }

    public function createrelance()
    {
        return view('customer.createrelance');
    }

    public function users()
    {
        return view('parametre.users');
    }

    public function logs()
    {
        return view('parametre.log');
    }

    public function enterprise()
    {
        return view('parametre.administration');
    }

    public function depenses()
    {
        return view('depenses.depenses');
    }

    public function createdepense()
    {
        return view('depenses.createdepenses');
    }

    public function categories()
    {
        return view('categories.categories');
    }

    public function prospect()
    {
        return view('prospect.prospect');
    }

    public function client()
    {
        return view('customer.client');
    }

    public function contrat()
    {
        return view('contrats.listecontrat');
    }

    public function createcontrat()
    {
        return view('contrats.createcontrat');
    }

    public function addavenant()
    {
        return view('contrats.avenant');
    }

    public function modifcontrat()
    {
        return view('contrats.modifcontrat');
    }

    public function print()
    {
        return view('contrats.print');
    }

    public function addauto()
    {
        return view('contrats.details');
    }

    public function viewfacture()
    {
        return view('contrats.facture');
    }

    public function viewusers()
    {
        return view('parametre.details');
    }

    public function detailauto()
    {
        return view('contrats.detailauto');
    }

    public function createprospect()
    {
        return view('prospect.createprospect');
    }

    public function apporteur()
    {
        return view('apporteur.apporteur');
    }

    public function createapporteur()
    {
        return view('apporteur.createapporteur');
    }

    public function editapporteur()
    {
        return view('apporteur.editapporteur');
    }

    public function branche()
    {
        return view('branche.branche');
    }

    public function createbranche()
    {
        return view('branche.createbranche');
    }

    public function modifapporteur()
    {
        return view('apporteur.modifapporteur');
    }

    public function compagnie()
    {
        return view('compagnie.compagnie');
    }

    public function createcompagnie()
    {
        return view('compagnie.createcompagnie');
    }

    public function modifcompagnie()
    {
        return view('compagnie.modifcompagnie');
    }

    public function sinistre()
    {
        return view('sinistre.listesinistre');
    }

    public function creersinistre()
    {
        return view('sinistre.creersinistre');
    }


    public function voirsinistre()
    {
        return view('sinistre.voirsinistre');
    }

    public function editsinistre()
    {
        return view('sinistre.editsinistre');
    }

    public function statcontrats()
    {
        return view('contrats.statcontrat');
    }

    public function viewprospect()
    {
        return view('prospect.viewprospect');
    }

}
