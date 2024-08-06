<?php

use App\Http\Controllers\AccidentIndividuelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RhController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BrancheController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\SinistreController;
use App\Http\Controllers\ApporteurController;
use App\Http\Controllers\CompagnieController;
use App\Http\Controllers\ProspectsController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\RetrieveDataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });




Route::post('post-registration', [EntrepriseController::class, 'postRegistration'])->name('register.post');
Route::post('post-reset', [EntrepriseController::class, 'postReset'])->name('reset.post');


Route::get('/check-internet-connection', function () {
    try {
        $connected = @fsockopen("www.google.com", 80);
        if ($connected) {
            fclose($connected);
            return response()->json(['connected' => true], 200);
        }
    } catch (\Exception $e) {
        return response()->json(['connected' => false], 200);
    }
    return response()->json(['connected' => false], 200);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/checktoken', [AuthController::class, 'checkToken']);
    Route::post('/validatetoken', [AuthController::class, 'validateToken']);

    Route::get('/user/profile', [AuthController::class, 'userProfile']);

    // Branche
    Route::controller(BrancheController::class)->group(function () {
        Route::get('/branchesList/{q?}', 'branchesList'); // Listes des branches avec pagignation et recherche
        Route::get('editbranche/{uuidBranche}', 'editBranche');
        Route::post('deletebranche/{uuidBranche}', 'deleteBranche'); // Suppression d'une branche 
        Route::post('updatebranche/{uuidBranche}', 'updateBranche'); // Update d'une branche
        Route::get('getBranche', 'getBranche'); // Obtenir les branches
    });

    //Form
    Route::controller(FormController::class)->group(function () {
        //Form get
        Route::get('getlocalisations', 'getLocalisations');
        Route::get('getprofessions', 'getProfessions');
        Route::get('getmarques', 'getMarques');
        Route::get('getenergies', 'getEnergies');
        Route::get('getcouleurs', 'getCouleurs');
        Route::get('getgenres', 'getGenres');
        Route::get('getcategories', 'getCategories');
        Route::get('getbranches', 'getBranches');
        Route::get('getsecteurs', 'getSecteurs');
        Route::get('getroles', 'getRoles');
        Route::get('getrolesActif', 'getRolesActif')->middleware('throttle:100,60');

        // Form post
        Route::post('postlocalisations', 'postLocalisations');
        Route::post('postprofessions', 'postProfessions');
        Route::post('postmarques', 'postMarques');
        Route::post('postenergies', 'postEnergies');
        Route::post('postcouleurs', 'postCouleurs');
        Route::post('postgenres', 'postGenres');
        Route::post('postcategories', 'postCategories');
        Route::post('postbranches', 'postBranches');
        Route::post('postsecteurs', 'postSecteurs');
        Route::post('createentreprise', 'createentreprise')->name('createentreprise');
    });

    // Apporteur
    Route::controller(ApporteurController::class)->group(function () {
        Route::get('/apporteurlist/{q?}', 'apporteursList'); // La liste des apporteurs
        Route::post('postapporteur', 'postApporteur'); // Ajouter un apporteur
        Route::get('editapporteur/{uuidApporteur}', 'editApporteur'); // Recuperer les infos d'un apporteur
        Route::patch('deleteapporteur/{uuidApporteur}', 'deleteApporteur'); // Supprimer un apporteur
        Route::patch('updateapporteur/{uuidApporteur}', 'updateApporteur'); // Update d'un apporteur
        Route::get('gettauxapporteur/{uuidApporteur}', 'getTauxApporteur'); // Obtenir les taux d'un apporteur
        Route::get('getnameapporteur/{uuidApporteur}', 'getNameApporteur'); // Obtenir le nom de l'apporteur choisi
        Route::get('edittauxapporteur/{uuidTauxApporteur}', 'editTauxApporteur'); //Recuperer les infos d'un taux
        Route::get('getbranchediffapporteur/{uuidTauxApporteur}', 'getBrancheDiffApporteur'); // Obtenir branche
        Route::post('posttauxapporteur', 'postTauxApporteur');
        Route::post('updatetauxapporteur/{uuidTauxApporteur}', 'updateTauxApporteur');
        Route::get('infoapporteur/{uuidApporteur}', 'infoApporteur');
        Route::get('getsommecommissionapporteur/{uuidApporteur}', 'getSommeCommissionApporteur');
        Route::get('getsommecommissionsapporteurpayer/{uuidApporteur}', 'getSommeCommissionsApporteurPayer');
        Route::get('getavenantbyuuid/{uuidAvenant}', 'getAvenantByUuid');
    });

    // Compagnies
    Route::controller(CompagnieController::class)->group(function () {
        Route::get('/compagnielist/{q?}',  'compagnieList'); // la liste des compagnies
        Route::post('postcompagnie',  'postCompagnie'); // Ajouter une compagnie
        Route::get('editcompagnie/{uuidCompagnie}',  'editCompagnie'); // Recuperer les infos de la compagnie
        Route::patch('deleteCompagnie/{uuidCompagnie}',  'deleteCompagnie'); // Supprimer une compagnie
        Route::patch('updatecompagnie/{uuidCompagnie}',  'updateCompagnie'); // Update d'une compagnie
        Route::get('gettauxcompagnie/{uuidCompagnie}',  'getTauxCompagnieByUuid'); // Obtenir les taux d'une compagnie
        Route::get('getnamecompagnie/{uuidCompagnie}',  'getNameCompagnie'); // Obtenir le nom de la compagnie choisi
        Route::get('edittauxcompagnie/{uuidTauxCompagnie}',  'editTauxCompagnie'); //Recuperer les infos d'un taux
        Route::get('getBrancheDiffCompagnie/{uuidCompagnie}',  'getBrancheDiffCompagnie'); // Obtenir branche
        Route::post('postTauxCompagnie',  'postTauxCompagnie');
        Route::post('updateTauxCompagnie',  'updateTauxCompagnie');
    });


    // Prospects
    Route::controller(ProspectsController::class)->group(function () {
        Route::get('prospectlist',  'prospectList');
        Route::post('postprospect',  'postProspect'); // Ajouter un contrat
        Route::get('editprospect/{uuidProspect}',  'editProspect');
        Route::post('validateprospect/{uuidProspect}',  'validateProspect');
        Route::post('deleteprospect/{uuidProspect}',  'deleteProspect');
        Route::post('etatprospect/{uuidProspect}',  'etatProspect');
        Route::post('updateprospect/{uuidProspect}',  'updateProspect'); // Update d'une compagnie
        Route::get('getbranchediffprospect/{uuidProspect}',  'getBrancheDiffProspect'); // Obtenir branche
        Route::post('postbrancheprospect/{uuidProspect}',  'postBrancheProspect');
        Route::get('getnameprospect/{uuidProspect}',  'getNameProspect'); // Obtenir le nom de l'apporteur choisi
        Route::get('getbrancheprospect/{uuidProspect}',  'getBrancheProspect');
        Route::get('getbrancheprospect/{uuidProspect}',  'getBrancheProspect');
        Route::get('getprospects',  'getProspect'); // Obtenir les prospects  getBrancheProspect
        Route::get('getbrancheprospects',  'getBrancheProspects'); // Obtenir les prospects  getBrancheProspect   
    });


    // Clients
    Route::controller(ClientController::class)->group(function () {
        Route::get('/clientList/{q?}', 'clientList');
        Route::post('postclient', 'postClient'); // Ajouter un apporteur
        Route::get('editclient/{uuidClient}', 'editClient');
        Route::post('updateclient/{uuidClient}', 'updateClient');
        Route::get('editRelance/{id_relance}', 'editRelance');
        Route::get('getrelance', 'getRelance');
        Route::get('getOneExpiration', 'getOneExpiration');
        Route::get('getTwoExpiration', 'getTwoExpiration');
        Route::get('client/branchbycustomer/{uuidClient}', 'getBranchByCustomer');
    });


    Route::controller(RetrieveDataController::class)->group(function () {
        Route::get('getclients', 'getClient');
        Route::get('gettauxcompagnies',  'getTauxCompagnies'); // Obtenir les taux des compagnies
        Route::get('getcompagnies',  'getCompagnie'); // Obtenir les compagnies
        Route::get('gettauxapporteurs', 'getTauxApporteurs'); // Obtenir les taux d'un apporteur
        Route::get('getapporteurs', 'getApporteur'); // Obtenir les compagnies
    });

    // Contrat
    Route::controller(ContratController::class)->group(function () {
        Route::get('/contratList/{q?}', 'contratList');
        Route::get('editcontrat/{uuidContrat}', 'editContrat');
        Route::post('postcontrat', 'postContrat'); // Ajouter un contrat
        Route::patch('deletecontrat/{uuidContrat}', 'deleteContrat');
        Route::post('soldeContrat', 'soldeContrat');
        Route::post('soldeAvenant', 'soldeAvenant');
        Route::post('reverseContrat', 'reverseContrat');
        Route::post('reverseAvenant', 'reverseAvenant');
        Route::get('getavenantcontrat/{uuidContrat}', 'getAvenantContrat'); // Obtenir les avenants d'un contrat
        Route::get('getinfoavenant/{uuidContrat}', 'getInfoAvenant');
        Route::get('editavenant/{uuidAvenant}', 'editAvenant');
        Route::post('deleteAvenant', 'deleteAvenant');
        Route::post('postAvenant', 'postAvenant'); // Ajouter un avenant
        Route::post('postfileavenants', 'postFileAvenant');
        Route::get('getfileavenants', 'getFileAvenant');
        Route::get('getinfoavenantcontrat/{uuidContrat}', 'getInfoAvenantContrat');
        Route::get('getinfocontrat/{uuidContrat}', 'getInfoContrat');
        Route::get('getCountsinistre', 'getCountsinistre');
        Route::get('getInfosinistres', 'getInfosinistres');
        Route::get('getInfoFileContrat', 'getInfoFileContrat');
        Route::get('getInfoFileSinistre', 'getInfoFileSinistre');
        Route::get('getinfovehicules/{uuidContrat}', 'getInfoVehicules');
        Route::post('postautomobile', 'postAutomobile');
        Route::post('postGarantie', 'postGarantie');
        Route::get('getFileViewAvenant/{id_avenant}', 'getFileViewAvenant');
        Route::get('gettauxbranchecompagnie', 'getTauxBrancheCompagnie');
        Route::get('gettauxbrancheapporteur', 'getTauxBrancheApporteur');
        Route::get('getViewContrat', 'getViewContrat');
        Route::post('updateContrat', 'updateContrat'); // Update d'un contrat
        Route::get('getfactures/{uuidAvenant}', 'getFactures');
        Route::get('getcontrats',  'getContrat'); // Obtenir les contrats
        Route::post('payeAvenant', 'payeAvenant'); // Update d'un contrat
        Route::get('getavenants', 'getAvenants'); // obtenir les avenants 
        Route::get('getautomobiles', 'getAutomobiles'); // obtenir les automobiles
        Route::get('getgaranties', 'getGaranties'); // obtenir les garanties

        Route::get('fileavenants/{uuidAvenant}', 'FileAvenant');
    });

    // Sinistres
    Route::controller(SinistreController::class)->group(function () {
        Route::get('get-polices', 'getPolices');
        Route::get('get/police/{id}', 'getPolice');
        Route::post('add/sinistre', 'addSinistre');
        Route::put('update/sinistre/{id}', 'updateSinistre');
        Route::get('get/sinistres/{q?}', 'getSinistres');
        Route::get('get/sinistre', 'getSinistre');
        Route::get('get/apporteur', 'getApporteur');
        Route::get('get/reglements', 'getDataReglements');
        Route::get('get/reglement', 'getDataReglement');
        Route::post('add/piece', 'addPiece');
        Route::put('update-sinistre-status/{id}', 'updateSinistreStatus');
        Route::post('add/reglement', 'addReglement');
        Route::put('change/reglement/{id}', 'changeReglement');
        Route::patch('sinistres/supprime/{id_sinistre}', 'supprime');
        Route::get('sinistres/edit/{id_sinistre}', 'edit');
        Route::get('getsinistres', 'getListSinistres'); // obtenir les garanties
        Route::get('getreglements', 'getReglements'); // obtenir les garanties
    });

    // Dashboard
    Route::get('/graph', [HomeController::class, 'graph'])->name('graph');
    Route::get('/stat', [HomeController::class, 'stat'])->name('stat');
    Route::get('/year', [HomeController::class, 'year'])->name('year');
    Route::get('/retrievebranche', [HomeController::class, 'retrievebranche']);

    // Entreprise
    Route::resource('entreprises', EntrepriseController::class);
    Route::get('entreprises/edit/{id_entreprise}', [EntrepriseController::class, 'edit']);
    Route::patch('validateentreprise', [EntrepriseController::class, 'validateEntreprise']);
    Route::patch('tarificationentreprise', [EntrepriseController::class, 'tarificationEntreprise']);

    // Statistiques
    Route::get('/modulestat', [StatController::class, 'modulestat'])->name('modulestat');
    Route::get('/synthese', [StatController::class, 'synthese'])->name('synthese');
    Route::get('detailsclient/{id_client}', [StatController::class, 'detailsclient'])->name('detailsclient');
    Route::get('detailscontrats/{id_contrat}', [StatController::class, 'detailscontrats'])->name('detailscontrats');
    Route::get('infosinistre/{id_contrat}', [StatController::class, 'infosinistre'])->name('infosinistre');
    Route::get('/sinis', [StatController::class, 'sinis'])->name('sinis');
    Route::get('/productions', [StatController::class, 'productions'])->name('productions');
    Route::get('/statapporteur', [StatController::class, 'statapporteur'])->name('statapporteur');
    Route::get('/statsupprime', [StatController::class, 'statsupprime'])->name('statsupprime');
    Route::get('detailsapporteurs/{id_apporteur}', [StatController::class, 'detailsapporteurs'])->name('detailsapporteurs');

    Route::get('/expiredata/{search?}', [StatController::class, 'expiredata']);

    // //  Roles
    Route::resource('roles', RoleController::class);


    // Users
    Route::resource('utilisateurs', UsersController::class);
    Route::controller(UsersController::class)->group(function () {
        Route::get('utilisateurs/edit/{id}', 'edit');
        Route::get('get/logs', 'getLogs');
        Route::get('getrole', 'getRole');
        Route::post('changepassword', 'changepassword');
    });

    // RH


    Route::controller(AccidentIndividuelController::class)->group(function () {
        Route::get('getreductiongroups', 'getReductionGroupe');
        Route::get('getassurancetemporaires', 'getAssuranceTemporaire');
        Route::get('gettarificateuraccidents', 'getTarificateurAccident');
        Route::get('gettarificationaccidents', 'getTarificationAccident');
        Route::get('getactivites', 'getActivite');
    });





    // Import de fichier
    Route::controller(UploadController::class)->group(function () {
        Route::post('importclient', 'importclient');
        Route::post('importprospect', 'importprospect');
        Route::post('importapporteur', 'importapporteur');
        Route::post('importauxapporteur', 'importauxapporteur');
        Route::post('importcompagnie', 'importcompagnie');
        Route::post('importauxcompagnie', 'importauxcompagnie');
        Route::post('importcontrat', 'importcontrat');
        Route::post('importsinistre', 'importsinistre');
        Route::post('importautomobile', 'importautomobile');
    });


    // Import de fichier
    Route::controller(SyncController::class)->group(function () {
        Route::post('sync-branches', 'syncBranche');
        Route::post('sync-prospects', 'syncProspect');
        Route::post('sync-clients', 'syncClient');
        Route::post('sync-compagnies', 'syncCompagnie');
        Route::post('sync-tauxcompagnies', 'syncTauxCompagnie');
        Route::post('sync-apporteurs', 'syncApporteur');
        Route::post('sync-tauxapporteurs', 'syncTauxApporteur');
        Route::post('sync-contrats', 'syncContrat');
        Route::post('sync-avenants', 'syncAvenant');
        Route::post('sync-automobiles', 'syncAutomobile');
        Route::post('sync-garanties', 'syncGarantie');
        Route::post('sync-sinistres', 'syncSinistre');
        Route::post('sync-reglements', 'syncReglement');
        Route::post('sync-categories', 'syncCategorie');
        Route::post('sync-marques', 'syncMarque');
        Route::post('sync-genres', 'syncGenre');
        Route::post('sync-couleurs', 'syncCouleur');
        Route::post('sync-energies', 'syncEnergie');
        Route::post('sync-activites', 'syncActivite');
        Route::post('sync-reductiongroups', 'syncReductionGroup');
        Route::post('sync-assurancetemporaires', 'syncAssuranceTemporaires');
        Route::post('sync-assurancetemporaires', 'syncAssuranceTemporaires');
        Route::post('sync-tarificateuraccidents', 'syncTarificateurAccidents');
        Route::post('sync-tarificationaccidents', 'syncTarificationAccidents');
    })->middleware('throttle:100,1');
});
