<?php

namespace App\Http\Controllers;

use App\Helpers\Cacher;
use App\Models\Avenant;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\ApporteurRequest;
use App\Http\Traits\AuthenticatesUsers;
use App\Repositories\ResponseRepository;
use App\Repositories\ApporteurRepository;

class ApporteurController extends Controller
{
    use AuthenticatesUsers;
    protected $apporteur;
    protected $tauxapporteur;
    protected $avenant;
    protected $response;
    protected $cacher;

    public function __construct(ApporteurRepository $apporteur, ApporteurRepository $tauxapporteur, ApporteurRepository $avenant, ResponseRepository $response, Cacher $cacher)
    {
        $this->apporteur = $apporteur;
        $this->tauxapporteur = $tauxapporteur;
        $this->avenant = $avenant;
        $this->response = $response;
        $this->cacher = $cacher;
    }

    /*
      |----------------------------------------------------
      | Liste des apporteurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'afficher
      | la liste de tous les apporteurs pour une entreorises 
      | spécifique qvec la possibilité de faire une recherche.
      |
     */

    public function apporteursList(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        $data = $request->all();

        try {
            $cacheKey = 'apporteur' . $user->id;
            $cachedApporteurs = $this->cacher->getCached($cacheKey);

            if ($cachedApporteurs) {
                $apporteurs = $cachedApporteurs;
            } else {
                $apporteurs = $this->apporteur->apporteursList($data, $user);
            }

            return $this->response->respondWithData($apporteurs, 'Apporteurs récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Ajoût des apporteurs
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter
      | des apporteurs.
      |
     */

    public function postApporteur(ApporteurRequest $request)
    {
        $user = $this->getAuthenticatedUser();

        // Validation du formulaire
        $validated = $request->validated();

        try {
            // Get data
            $data = $request->all();

            // Insert in database
            $Data = $this->apporteur->postApporteur($data, $user);

            if ($Data) {
                // Convert the data to an array
                $DataArray = json_decode(json_encode($Data), true);

                // Cache the customer data
                $this->cacher->setCached('apporteur' . $user->id, $DataArray);

                return $this->response->respondWithToken($Data, $user, 'Apporteur ajouté avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Recupérer les infos apporteurs
      |----------------------------------------------------
      |
      | Cette fonction permet de recupérer les infos
      | des apporteurs en fonction de l'id.
      |
     */

    public function editApporteur($uuidApporteur)
    {
        try {
            $apporteurs = $this->apporteur->editApporteur($uuidApporteur);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Supprimer  apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet de supprimer un apporteur.
      |
     */

    public function deleteApporteur(Request $request, $uuidApporteur)
    {

        $user = $this->getAuthenticatedUser();
        try {
            $Data = $this->apporteur->deleteApporteur($uuidApporteur, $user);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Apporteur supprimé avec succès.');
            } else {
                return $this->response->respondWithError('Failed to delete.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while deleting.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Recupérer les infos d'un taux
      |----------------------------------------------------
      |
      | Cette fonction permet de recupérer les infos
      | d'un taux en fonction de l'apporteur.
      |
     */

    public function editTauxApporteur($uuidTauxApporteur)
    {
        try {
            $apporteurs = $this->tauxapporteur->editTauxApporteur($uuidTauxApporteur);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Mise à jour apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet de mettre à jour les infos
      | un apporteur d'un apporteur en fonction de son uuid.
      |
     */

    public function updateApporteur(Request $request, $uuidApporteur)
    {
        $user = $this->getAuthenticatedUser();
        try {
            // Get data
            $data = $request->all();
            $Data = $this->apporteur->updateApporteur($data, $uuidApporteur, $user);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Client modifié avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create customer.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the customer.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Obtenir les taux  apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet d'obtenir la liste des taux d'un apporteur.
      |
     */

    public function getTauxApporteur($uuidApporteur)
    {
        $user = $this->getAuthenticatedUser();
        try {
            $apporteurs = $this->tauxapporteur->getTauxApporteur($uuidApporteur, $user);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Obtenir le nom de l'apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet d'obtenir le nom de l'apporteur
      |
      | en fonction du uuid
      |
     */

    public function getNameApporteur($uuidApporteur)
    {

        try {
            $apporteurs = $this->apporteur->getNameApporteur($uuidApporteur);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Obtenir la différence de branche
      |----------------------------------------------------
      |
      | Cette fonction permet d'obtenir la différence 
      |
      | 
      |
     */

    public function getBrancheDiffApporteur($uuidApporteur)
    {
        try {
            $apporteurs = $this->tauxapporteur->getBrancheDiffApporteur($uuidApporteur);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Ajouter un taux
      |----------------------------------------------------
      |
      | Cette fonction permet d'ajouter un taux 
      |
      | à un apporteur
      |
     */

    public function postTauxApporteur(Request $request)
    {

        $user = $this->getAuthenticatedUser();
        try {
            $data = $request->all();
            $Data = $this->tauxapporteur->postTauxApporteur($data);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Taux apporteur ajouter avec succès.');
            } else {
                return $this->response->respondWithError('Failed to add.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while adding.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Mise à jour  d'un taux
      |----------------------------------------------------
      |
      | Cette fonction permet de mettre à jour un taux 
      |
      | en fonction du uuid
      |
     */

    public function updateTauxApporteur(Request $request, $uuidTauxApporteur)
    {
        $user = $this->getAuthenticatedUser();
        try {
            $data = $request->all();
            $Data = $this->tauxapporteur->updateTauxApporteur($data, $uuidTauxApporteur);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Taux apporteur modifié avec succès.');
            } else {
                return $this->response->respondWithError('Failed to edit.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while editing.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Obtenir la liste des avenants de l'apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet de lister les avenants  
      |
      | de l'apporteur en fonction du uuid
      |
     */


    public function infoApporteur($uuidApporteur)
    {
        try {
            $apporteurs = $this->avenant->infoApporteur($uuidApporteur);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Obtenir la commission de l'apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet d'obtenir la commsion de l'apporteur
      |
      | en fonction du uuid
      |
     */
    public function getSommeCommissionApporteur($uuidApporteur)
    {
        try {
            $apporteurs = $this->avenant->getSommeCommissionApporteur($uuidApporteur);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Obtenir la commission de l'apporteur
      |----------------------------------------------------
      |
      | Cette fonction permet d'obtenir la commsion de l'apporteur
      |
      | payer en fonction du uuid
      |
     */

    public function getSommeCommissionsApporteurPayer($uuidApporteur)
    {
        try {
            $apporteurs = $this->avenant->getSommeCommissionsApporteurPayer($uuidApporteur);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }

    /*
      |----------------------------------------------------
      | Obtenir les avenants 
      |----------------------------------------------------
      |
      | Cette fonction permet d'obtenir les avenants 
      |
      | en fonction du uuid
      |
     */

    public function getAvenantByUuid($uuidAvenant)
    {
        try {
            $apporteurs = $this->avenant->getAvenantByUuid($uuidAvenant);
            return $this->response->respondWithData($apporteurs, 'Les informations  ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving.', 500, $e->getMessage());
        }
    }
}
