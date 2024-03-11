<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class BrancheController extends Controller
{
    public function branchesList(Request $request)
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $data = strlen($request->q);

        if ($data > 0) {
            $branches['data'] =  Branche::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_branche', '=', '0')
                ->where('nom_branche', 'like', '%' . request('q') . '%')
                ->orderByDesc('id_branche')
                ->get();

            return response()->json($branches);
        } else {
            $branches = Branche::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_branche', 0)
                ->orderByDesc('id_branche')
                ->paginate(10);

            return response()->json($branches);
        }
    }
    public function editBranche($id_branche)
    {
        $branches = Branche::findOrFail($id_branche);
        return response()->json($branches);
    }


    public function updateBranche(Request $request, $id_branche)
    {
        $branches = Branche::find($id_branche);
        $branches->nom_branche = $request->nom_branche;
        $branches->save();

        if ($branches) {
            $branches =  Branche::where('id_entreprise', $request->id_entreprise)
                ->where('supprimer_branche', 0)
                ->orderByDesc('id_branche')
                ->get();

            return response()->json($branches);
        }
    }

    public function deleteBranche(Request $request,$id_branche)
    {
        $branches = Branche::find($id_branche);
        $branches->supprimer_branche = 1;
        $branches->save();

        if ($branches) {
            $branches =  $branches =  Branche::where('id_entreprise', $request->id_entreprise)
                ->where('supprimer_branche', 0)
                ->orderByDesc('id_branche')
                ->get();

            return response()->json($branches);
        }
    }

    public function getBranche()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $branches = Branche::where('id_entreprise', $user->id_entreprise)
            ->where('supprimer_branche', 0)
            ->where('id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($branches);
    }

    private function refresh()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $branches = Branche::where('id_entreprise', $user->id_entreprise)->where('supprimer_branche', '=', '0')->orderByDesc('id_branche')->get();
        return response()->json($branches);
    }
}
