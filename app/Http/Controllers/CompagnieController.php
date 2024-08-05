<?php

namespace App\Http\Controllers;

use App\Helpers\Cacher;
use App\Models\Branche;
use App\Models\Compagnie;
use Illuminate\Http\Request;
use App\Models\TauxCompagnie;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompagnieRequest;
use App\Http\Traits\AuthenticatesUsers;
use App\Repositories\ResponseRepository;
use App\Repositories\CompagnieRepository;
use Symfony\Component\HttpFoundation\Response;

class CompagnieController extends Controller
{
    use AuthenticatesUsers;
    protected $compagnie;
    protected $response;
    protected $cacher;

    public function __construct(CompagnieRepository $compagnie, ResponseRepository $response, Cacher $cacher)
    {
        $this->compagnie = $compagnie;
        $this->response = $response;
        $this->cacher = $cacher;
    }


    /*
      |----------------------------------------------------
      | Liste des compagnies 
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste de tous les compagnies pour une entreorises 
      | spécifique qvec la possibilité de faire une recherche.
      |
     */
    public function compagnieList(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        $data = $request->all();

        try {
            $cacheKey = 'compagnie_' . $user->id;
            $cachedCompagnies = $this->cacher->getCached($cacheKey);

            if ($cachedCompagnies) {
                $compagnies = $cachedCompagnies;
            } else {
                $compagnies = $this->compagnie->compagnieList($data, $user);
            }

            return $this->response->respondWithData($compagnies, 'Compagnies récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving company.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Ajoût des compagnies
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter
      | des compagnies.
      |
     */


    public function postCompagnie(CompagnieRequest $request)
    {

        $user = $this->getAuthenticatedUser();

        // Validation du formulaire
        $validated = $request->validated();

        try {
            // Get data
            $data = $request->all();

            // Insert in database
            $Data = $this->compagnie->postCompagnie($data, $user);

            if ($Data) {
                // Convert the data to an array
                $DataArray = json_decode(json_encode($Data), true);

                // Cache the customer data
                $this->cacher->setCached('compagnie' . $user->id, $DataArray);

                return $this->response->respondWithToken($Data, $user, 'compagnie ajouté avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create company.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }

    public function editCompagnie($uuidCompagnie)
    {
        try {
            $compagnies = $this->compagnie->editCompagnie($uuidCompagnie);
            return $this->response->respondWithData($compagnies, 'Les informations du client ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving customer.', 500, $e->getMessage());
        }
    }

    public function updateCompagnie(Request $request, $uuidCompagnie)
    {
        $user = $this->getAuthenticatedUser();
        try {
            // Get data
            $data = $request->all();
            $Data = $this->compagnie->updateCompagnie($data, $uuidCompagnie, $user);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'compagnie modifié avec succès.');
            } else {
                return $this->response->respondWithError('Failed to update compagny.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while updating the company.', 500, $e->getMessage());
        }
    }

    public function deleteCompagnie(Request $request, $uuidCompagnie)
    {
        $user = $this->getAuthenticatedUser();
        try {
            // Get data
            $data = $request->all();
            $Data = $this->compagnie->deleteCompagnie($data, $uuidCompagnie, $user);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'compagnie supprimé avec succès.');
            } else {
                return $this->response->respondWithError('Failed to delete compagny.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while deleting the company.', 500, $e->getMessage());
        }
    }

    public function getTauxCompagnieByUuuid($uuidCompagnie)
    {
        $user = $this->getAuthenticatedUser();
        try {
            $compagnies = $this->compagnie->editCompagnie($uuidCompagnie, $user);
            return $this->response->respondWithData($compagnies, 'Les informations ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }


    public function getNameCompagnie($uuidCompagnie)
    {
        try {
            $compagnies = $this->compagnie->getNameCompagnie($uuidCompagnie);
            return $this->response->respondWithData($compagnies, 'Les informations ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    public function editTauxCompagnie($uuidTauxCompagnie)
    {
        try {
            $compagnies = $this->compagnie->editTauxCompagnie($uuidTauxCompagnie);
            return $this->response->respondWithData($compagnies, 'Les informations ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    public function getBrancheDiffCompagnie($uuidCompagnie)
    {
        try {
            $compagnies = $this->compagnie->getBrancheDiffCompagnie($uuidCompagnie);
            return $this->response->respondWithData($compagnies, 'Les informations ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    public function postTauxCompagnie(Request $request)
    {
        $user = $this->getAuthenticatedUser();

        // Validation du formulaire
        // $validated = $request->validated();

        try {
            // Get data
            $data = $request->all();

            // Insert in database
            $Data = $this->compagnie->postTauxCompagnie($data, $user);

            if ($Data) {
                // Convert the data to an array
                $DataArray = json_decode(json_encode($Data), true);

                // Cache the customer data
                $this->cacher->setCached('tauxcompagnie' . $user->id, $DataArray);

                return $this->response->respondWithToken($Data, $user, 'Taux compagnie ajouté avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create company.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }

    public function updateTauxCompagnie(Request $request)
    {
        $user = $this->getAuthenticatedUser();

        try {
            // Get data
            $data = $request->all();

            // Insert in database
            $Data = $this->compagnie->updateTauxCompagnie($data, $user);

            if ($Data) {
                // Convert the data to an array
                $DataArray = json_decode(json_encode($Data), true);

                // Cache the customer data
                $this->cacher->updateCached('tauxcompagnie' . $user->id, $DataArray);

                return $this->response->respondWithToken($Data, $user, 'Taux compagnie ajouté avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create company.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }
}
