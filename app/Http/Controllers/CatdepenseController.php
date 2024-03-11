<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategorieType;
use App\Models\CategorieDepense;
use Illuminate\Support\Facades\Auth;

class CatdepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategorieDepense::all();

        return response()->json($categories);
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
        $categorie = $request->nom_secteur;
        if (CategorieDepense::where('nom_secteur', '=', $categorie)->where('id_entreprise', Auth::user()->id_entreprise)->count() > 0) {
            return response()->json(['message' => 'Catégorie existante'], 422);
        } else {
            $categories = new CategorieDepense();
            $categories->nom_secteur = $request->nom_secteur;
            $categories->id_entreprise = Auth::user()->id_entreprise;
            $categories->user_id = Auth::user()->id;
            $categories->save();
            return response()->json($categories);
        }
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

    public function assoc(Request $request)
    {
        $categorie = $request->categorie_id;
        $type = $request->expense_id;
        // dd($type);

        if (CategorieType::where('id_catdep', '=', $categorie)->where('id_typedep', '=', $type)->where('id_entreprise', Auth::user()->id_entreprise)->count() > 0) {
            return response()->json(['message' => 'Catégorie existante'], 422);
        } else {
            $categories = new CategorieType();
            $categories->id_catdep = $request->categorie_id;
            $categories->id_typedep = $request->expense_id;
            $categories->id_entreprise = Auth::user()->id_entreprise;
            $categories->user_id = Auth::user()->id;
            $categories->save();
            return response()->json($categories);
        }
    }

    public function getdepense(Request $request)
    {
        $data = CategorieType::select('type_depenses.id_typedep', 'nom_type')->join("type_depenses", 'categorie_types.id_typedep', '=', 'type_depenses.id_typedep')->where('id_catdep', $request->id_catdep)->get();

        return response()->json($data);
    }

    public function getresult(Request $request)
    {

        $results = CategorieType::join("categorie_depenses", 'categorie_types.id_catdep', '=', 'categorie_depenses.id_catdep')
            ->join("type_depenses", 'categorie_types.id_typedep', '=', 'type_depenses.id_typedep')
            ->where('type_depenses.id_entreprise', Auth::user()->id_entreprise)
            ->get();

        return response()->json($results);
    }
}
