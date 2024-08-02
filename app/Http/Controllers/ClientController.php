<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Helpers\Cacher;
use App\Models\Contrat;
use App\Models\Relance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Repositories\ClientRepository;
use App\Http\Traits\AuthenticatesUsers;
use App\Repositories\ResponseRepository;
use App\Http\Requests\CustomerStoreRequest;

class ClientController extends Controller
{
    use AuthenticatesUsers;
    protected $client;
    protected $response;
    protected $cacher;

    public function __construct(ClientRepository $client, ResponseRepository $response, Cacher $cacher)
    {
        $this->client = $client;
        $this->response = $response;
        $this->cacher = $cacher;
    }

    public function clientList(Request $request)
    {
        $user = $this->getAuthenticatedUser();
        $data = $request->all();

        try {
            $cacheKey = 'client_' . $user->id;
            $cachedClients = $this->cacher->getCached($cacheKey);

            if ($cachedClients) {
                $clients = $cachedClients; // Les données sont déjà décodées en tableau
            } else {
                $clients = $this->client->clientList($data, $user);
            }

            return $this->response->respondWithData($clients, 'Clients récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving customer.', 500, $e->getMessage());
        }
    }

    public function postClient(CustomerStoreRequest $request)
    {
        $user = $this->getAuthenticatedUser();

        // Validation du formulaire
        $validated = $request->validated();

        try {
            // Get data
            $data = $request->all();

            // Insert in database
            $Data = $this->client->postClient($data, $user);

            if ($Data) {
                // Convert the data to an array
                $DataArray = json_decode(json_encode($Data), true);

                // Cache the customer data
                $this->cacher->setCached('client' . $user->id, $DataArray);

                return $this->response->respondWithToken($Data, $user, 'client ajouté avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create customer.');
            }
        } catch (\Exception $exception) {
            die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return response()->json(['message' => 'Apporteur non enregistré'], 422);
        } catch (\Illuminate\Database\QueryException $queryException) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $queryException->getMessage());
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $modelNotFoundException) {
            // Handle model not found errors
            return response()->json(['message' => 'Le modèle demandé n\'a pas été trouvé.'], 404);
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the prospect.', 500, $e->getMessage());
        }
    }

    public function editClient($uuidClient)
    {
        try {
            $clients = $this->client->editClient($uuidClient);
            return $this->response->respondWithData($clients, 'Les informations du client ont été récupérés avec succès.');
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while retrieving customer.', 500, $e->getMessage());
        }
    }

    public function updateClient(Request $request, $uuidClient)
    {
        $user = $this->getAuthenticatedUser();
        try {
            // Get data
            $data = $request->all();
            $Data = $this->client->updateClient($data, $uuidClient, $user);

            if ($Data) {
                return $this->response->respondWithToken($Data, $user, 'Client modifié avec succès.');
            } else {
                return $this->response->respondWithError('Failed to create customer.');
            }
        } catch (\Exception $e) {
            return $this->response->respondWithError('An error occurred while creating the customer.', 500, $e->getMessage());
        }
    }



    public function getRelance()
    {
        $relances = Relance::with('clients')->orderBy('id_relance', 'DESC')->get();

        return response()->json($relances);
    }

    public function postRelance(Request $request)
    {
        // dd($request->all());
        // if ($request->users_team == []) {
        //     return response()->json(['message' => 'Il n y a de client'], 422);
        // } else {
        // dd($request->all());
        if ($request->types == "Echeances") {
            if ($request->periode == "1 semaine") {
                $jours = 7;
            } else if ($request->periode == "2 semaine") {
                $jours = 14;
            } else if ($request->periode == "1 mois") {
                $jours = 30;
            }

            $client = Client::where('id_entreprise', Auth::user()->id_entreprise)->count();
            $contrat = Contrat::where('id_entreprise', Auth::user()->id_entreprise)->count();
            if ($contrat == 0) {
                return response()->json(['message' => 'Il n y a de client'], 422);
            } else {
                $semaine = Contrat::select('nom_client', 'clients.id_client', 'primes_ttc', 'expire_le', 'civilite', 'numero_police', 'accessoires', 'taxes_totales', 'cfga')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->where('expire_le', '<=', Carbon::now()->subDays($jours))
                    ->get();

                dd($semaine);

                $arrays = json_decode(json_encode($semaine), true);
                $br = $arrays[0];
                $primes = $br['primes_ttc'];
                $taxes = $br['taxes_totales'];
                $expire = $br['expire_le'];
                $police = $br['numero_police'];
                $civilite = $br['civilite'];
                $cfga = $br['cfga'];
                $name = $br['nom_client'];
                dd($br);

                $emails = Contrat::select('clients.email_client', 'clients.id_client')
                    ->join("clients", 'contrats.id_client', '=', 'clients.id_client')
                    ->where('expire_le', '<=', Carbon::now()->subDays($jours))
                    ->get();
                $arrayemail = json_decode(json_encode($emails), true);
                $aremail = $arrayemail[0];
                $to_email = $aremail['clients.email_client'];
                $id = $aremail['clients.id_client'];


                // envoi de mail
                if ($request->isMethod('post')) {
                    $data = $request->all();

                    $data = array(
                        "body" => "Notification de création de projet",
                        'objet' => $data['objet'],
                        'primes' => $primes,
                        'taxes' => $taxes,
                        'civilite' => $civilite,
                        'expire' => $expire,
                        'police' => $police,
                        'cfga' => $cfga,
                        'name' => $name,
                    );

                    Mail::send('emails.echeances', $data, function ($message) use ($to_email) {
                        $message->to($to_email)
                            ->subject('Avis d’échéance');
                        $message->from('flairapplication@gmail.com', 'FLAIR');
                    });
                }

                $now = date('Y-m-d');

                $relances = new Relance();
                $relances->date_relance = $now;
                $relances->message = $request->message;
                $relances->objet = $request->objet;
                $relances->type = $request->types;
                $relances->save();

                //Lier un utilisateur a une tâche
                $relances->clients()->attach($id);
            }
        } elseif ($request->types == "Certains clients") {
            dd($request->all());
            $now = date('Y-m-d');
            $relances = new Relance();
            $relances->date_relance = $now;
            $relances->message = $request->message;
            $relances->objet = $request->objet;
            $relances->type = $request->types;
            $relances->save();

            $chef = $request['users_team'];

            //Lier un utilisateur a une tâche
            $relances->clients()->attach($chef);

            if ($request->objet == "AVIS ECHEANCE AUTO") {

                // envoi de mail
                if ($request->isMethod('post')) {

                    $data = $request->all();
                    $name = $request->users_team;

                    // Nom du client
                    $b = DB::table('clients')->select('nom_client')->where('id_client', $name)->get();
                    $arrays = json_decode(json_encode($b), true);
                    $br = $arrays[0];
                    $name = $br['nom_client'];

                    // Civilité
                    $civil = DB::table('clients')->select('civilite')->where('id_client', $name)->get();
                    $arraysc = json_decode(json_encode($civil), true);
                    $cr = $arraysc[0];
                    $civilite = $cr['civilite'];


                    $mails = DB::table('clients')->select('email_client')->whereIn('id_client', $name)->get();

                    foreach ($mails as $mail) {
                        $respos_email[] = $mail->email;
                    }

                    $data = array(
                        "body" => "AVIS ECHEANCE",
                        'nom_client' => $name,
                        'cibilite' => $civilite,
                    );

                    Mail::send('emails.avis', $data, function ($message) use ($respos_email) {
                        $message->to($respos_email)
                            ->subject('AVIS ECHEANCE');
                        $message->from('flairapplication@gmail.com', 'FLAIR');
                    });
                }
            } else {
                $data = $request->all();
                $name = $request->users_team;

                // Nom du client
                $b = DB::table('clients')->select('nom_client')->where('id_client', $name)->get();
                $arrays = json_decode(json_encode($b), true);
                $br = $arrays[0];
                $name = $br['nom_client'];

                // Civilité
                $civil = DB::table('clients')->select('civilite')->where('id_client', $name)->get();
                $arraysc = json_decode(json_encode($civil), true);
                $cr = $arraysc[0];
                $civilite = $cr['civilite'];


                $mails = DB::table('clients')->select('email_client')->whereIn('id_client', $name)->get();

                foreach ($mails as $mail) {
                    $respos_email[] = $mail->email;
                }

                $data = array(
                    "body" => "AVIS ECHEANCE",
                    'nom_client' => $name,
                    'cibilite' => $civilite,
                );

                Mail::send('emails.avis', $data, function ($message) use ($respos_email) {
                    $message->to($respos_email)
                        ->subject('AVIS ECHEANCE');
                    $message->from('flairapplication@gmail.com', 'FLAIR');
                });
            }
        } else if ($request->types == "Tous les clients") {
            $now = date('Y-m-d');
            $relances = new Relance();
            $relances->date_relance = $now;
            $relances->message = $request->message;
            $relances->objet = $request->objet;
            $relances->objet = $request->objet;
            $relances->save();

            $chef = $request['users_team'];

            //Lier un utilisateur a une tâche
            $relances->clients()->attach($chef);
        }
        // }
    }

    public function editRelance()
    {
    }

    public function getOneExpiration()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $firsts = Contrat::select('expire_le')->join("branches", 'branches.id_branche', '=', 'contrats.id_branche')
            ->join("compagnies", 'compagnies.id_compagnie', '=', 'contrats.id_compagnie')
            ->join("clients", 'clients.id_client', '=', 'contrats.id_client')
            ->where('contrats.id_entreprise', $user->id_entreprise)
            // ->whereBetween('expire_le', [$startDate, $endDate])
            ->where('expire_le', '<=', Carbon::now()->addDays(30)->toDateString())
            ->get();

        // dd($firsts);

        return response()->json($firsts);
    }

    public function getTwoExpiration()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $seconds = Contrat::join("clients", 'clients.id_client', '=', 'contrats.id_client')
            ->join("branches", 'branches.id_branche', '=', 'contrats.id_branche')
            ->join("compagnies", 'compagnies.id_compagnie', '=', 'contrats.id_compagnie')
            ->where('contrats.id_entreprise', $user->id_entreprise)
            ->where('effet_police', '<=', Carbon::now()->addDays(60)->toDateTimeString())
            ->get();

        return response()->json($seconds);
    }

    public function getBranchByCustomer($uuidClient)
    {
        $clients = Client::with(['contrats'])->where('uuidClient', $uuidClient)->get();

        return response()->json($clients);
    }
}
