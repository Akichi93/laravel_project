<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditures = Depense::join("categorie_depenses", 'depenses.id_catdep', '=', 'categorie_depenses.id_catdep')
            ->join("type_depenses", 'depenses.id_typedep', '=', 'type_depenses.id_typedep')
            ->where('depenses.id_entreprise',Auth::user()->id_entreprise)
            ->orderBy('id_depense', 'DESC')
            ->get();

        return response()->json($expenditures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
