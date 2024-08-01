<?php

namespace App\Http\Controllers;

use App\Models\Branche;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
                ->orderByDesc('uuidBranche')
                ->get();

            return response()->json($branches);
        } else {
            $branches = Branche::where('id_entreprise', $user->id_entreprise)
                ->where('supprimer_branche', 0)
                ->orderByDesc('uuidBranche')
                ->paginate(10);

            return response()->json($branches);
        }
    }
    public function editBranche($uuidBranche)
    {
        $branches = Branche::where('uuidBranche', $uuidBranche)->first();
        return response()->json($branches);
    }


    public function updateBranche(Request $request, $uuidBranche)
    {
        $branches = Branche::where('uuidBranche', $uuidBranche)->update([
            'nom_branche' => $request->nom_branche,
        ]);

        if ($branches) {
            $branches =  Branche::where('id_entreprise', $request->id_entreprise)
                ->where('supprimer_branche', 0)
                ->orderByDesc('uuidBranche')
                ->get();
                
            return response()->json($branches);
        }
    }

    public function deleteBranche(Request $request, $uuidBranche)
    {
        $branches = Branche::where('uuidBranche', $uuidBranche)->update([
            'supprimer_branche' => 1,
        ]);

        if ($branches) {
            $branches =  $branches =  Branche::where('id_entreprise', $request->id_entreprise)
                ->where('supprimer_branche', 0)
                ->orderByDesc('uuidBranche')
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
