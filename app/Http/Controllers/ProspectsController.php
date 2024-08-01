<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Branche;
use App\Models\Prospect;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\BrancheProspect;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Http\Traits\AuthenticatesUsers;
use App\Repositories\ProspectRepository;
use App\Repositories\ResponseRepository;
use App\Http\Requests\ProspectStoreRequest;
use App\Helpers\Cacher;

class ProspectsController extends Controller
{
    use AuthenticatesUsers;
    protected $prospect;
    protected $response;
    protected $cacher;

    public function __construct(ProspectRepository $prospect, ResponseRepository $response, Cacher $cacher)
    {
        $this->prospect = $prospect;
        $this->response = $response;
        $this->cacher = $cacher;
    }

    public function prospectList(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        $data = $request->all();

        try {
            $cacheKey = 'prospect_' . $user->id;
            $cachedProspects = $this->cacher->getCached($cacheKey);

            if ($cachedProspects) {
                $prospects = $cachedProspects; // Les données sont déjà décodées en tableau
            } else {
                $prospects = $this->prospect->getProspect($data, $user);
                // $this->cacher->setCached($cacheKey, $prospects);
            }

            return $this->response->respondWithData($prospects, 'Prospects récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving categories.', 500, $e->getMessage());
        }
    }


    public function editProspect($uuidProspect)
    {
        try {
            $prospects = $this->prospect->editProspect($uuidProspect);
            return $this->response->respondWithData($prospects, 'Les informations du prospect ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving categories.', 500, $e->getMessage());
        }
    }

    public function postProspect(ProspectStoreRequest $request)
    {
        $user = $this->getAuthenticatedUser();

        try {
            // Get data
            $data = $request->all();

            // Insert in database
            $Data = $this->prospect->postProspect($data, $user);

            if ($Data) {
                // Convert the data to an array
                $DataArray = json_decode(json_encode($Data), true);

                // Cache the prospect data
                $this->cacher->setCached('prospect_' . $user->id, $DataArray);

                return $this->response->respondWithToken($Data, $user, 'Prospect ajouté avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create Prospect.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }


    public function updateProspect(Request $request, $uuidProspect)
    {
        $user = $this->getAuthenticatedUser();
        try {
            // Get data
            $data = $request->all();
            $Data = $this->prospect->updateProspect($data, $uuidProspect, $user);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Prospect modifié avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create Prospect.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }


    public function validateProspect(Request $request, $uuidProspect)
    {
        $user = $this->getAuthenticatedUser();

        try {
            // Get data
            $data = $request->all();
            $Data = $this->prospect->updateProspect($data, $uuidProspect, $user);


            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Client ajouté avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create Customer.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }

    public function deleteProspect(Request $request, $uuidProspect)
    {
        $user = $this->getAuthenticatedUser();

        try {
            // Get data
            $data = $request->all();
            $Data = $this->prospect->deleteProspect($data, $uuidProspect, $user);


            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Client supprimé avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create Customer.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }

    public function etatProspect(Request $request, $uuidProspect)
    {
        $user = $this->getAuthenticatedUser();
        try {
            // Get data
            $data = $request->all();
            $Data = $this->prospect->etatProspect($data, $uuidProspect, $user);


            if ($Data) {
                // Convert the data to an array
                $DataArray = json_decode(json_encode($Data), true);

                // Cache the prospect data
                $this->cacher->updateCached('prospect_' . $user->id, $DataArray);
                return $this->response->respondWithToken($Data, $user, 'Changement d"état avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create Customer.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }

    public function getBrancheDiffProspect($uuidProspect)
    {
        $user = $this->getAuthenticatedUser();
        try {
            $branches = $this->prospect->getBrancheDiffProspect($uuidProspect, $user);
            return $this->response->respondWithData($branches, 'Les informations du prospect ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving categories.', 500, $e->getMessage());
        }
    }

    public function postBrancheProspect(Request $request, $uuidProspect)
    {

        $user = $this->getAuthenticatedUser();
        try {
            // Get data
            $data = $request->all();
            $Data = $this->prospect->postBrancheProspect($data, $uuidProspect);


            if ($Data) {
                // Convert the data to an array
                // $DataArray = json_decode(json_encode($Data), true);

                // // Cache the prospect data
                // $this->cacher->updateCached('prospect_' . $user->id, $DataArray);
                return $this->response->respondWithToken($Data, $user, 'Changement d"état avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create Customer.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }

    public function getNameProspect($uuidProspect)
    {
        try {
            $prospects = $this->prospect->getNameProspect($uuidProspect);
            return $this->response->respondWithData($prospects, 'Les informations du prospect ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving categories.', 500, $e->getMessage());
        }
    }

    public function getBrancheProspect($uuidProspect)
    {
        try {
            $prospects = $this->prospect->getBrancheProspect($uuidProspect);
            return $this->response->respondWithData($prospects, 'Les informations du prospect ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving categories.', 500, $e->getMessage());
        }

    }

    public function getProspect()
    {
        $user =  JWTAuth::parseToken()->authenticate();

        $prospects = Prospect::select('adresse_prospect', 'civilite', 'email_prospect', 'etat', 'fax_prospect', 'id_entreprise', 'nom_prospect', 'user_id as id', 'profession_prospect', 'postal_prospect', 'statut', 'supprimer_prospect', 'sync', 'tel_prospect', 'uuidProspect')
            ->where('id_entreprise', $user->id_entreprise)
            ->where('supprimer_prospect', 0)
            ->get();

        // $prospects = $this->apporteur->getApporteur();

        return response()->json($prospects);
    }

    public function getBrancheProspects()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $prospects = BrancheProspect::join("branches", 'branche_prospects.id_branche', '=', 'branches.id_branche')
            ->where('uuidProspect', $user->id_entreprise)
            ->get();

        return response()->json($prospects);
    }
}
