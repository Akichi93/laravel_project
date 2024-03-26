<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Contrat;
use App\Models\Relance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class ClientController extends Controller
{
    public function clientList(Request $request)
    {

        $user =  JWTAuth::parseToken()->authenticate();
        $data = strlen($request->q);
        if ($data > 0) {
            $clients['data'] = Client::where('id_entreprise', $user->id_entreprise)
                ->where('nom_client', 'like', '%' . request('q') . '%')
                ->orWhere('adresse_client', 'like', '%' . request('q') . '%')
                ->orWhere('numero_client', 'like', '%' . request('q') . '%')
                ->orWhere('profession_client', 'like', '%' . request('q') . '%')
                ->latest()
                ->get();
            return response()->json($clients);
        } else {
            $clients = Client::where('id_entreprise', $user->id_entreprise)->latest()->paginate(10);
            return response()->json($clients);
        }
    }

    public function postClient(Request $request)
    {
        //validation
        $rules = [
            'civilite' => 'required',
            'nom_client' => 'required',
            'tel_client' => 'required|numeric',
            'adresse_client' => 'required',
            'profession_client' => 'required',
            'email_client' => 'required|email|unique:clients',
        ];

        $customMessages = [
            'civilite.required' => 'Selectionnez la civilité',
            'nom_client.required' => 'Veuillez entrer le nom du client',
            'tel_client.required' => 'Veuillez entrer le contact de l\'apporteur',
            'tel_client.numeric' => 'Veuillez entrer un contact de',
            'adresse_client.required' => 'Veuillez entrer l\'adresse du client',
            'profession_client.required' => 'Veuillez entrer la profession du client',
            'email_client.required' => 'Veuillez entrer',
        ];

        $this->validate($request, $rules, $customMessages);

        try {
            $clients = new Client();
            $clients->numero_client = $request->numero_client;
            $clients->civilite = $request->civilite;
            $clients->nom_client = $request->nom_client;
            $clients->tel_client = $request->tel_client;
            $clients->postal_client = $request->postal_client;
            $clients->adresse_client = $request->adresse_client;
            $clients->profession_client = $request->profession_client;
            $clients->fax_client = $request->fax_client;
            $clients->email_client = $request->email_client;
            $clients->id_entreprise = $request->id_entreprise;
            $clients->uuidClient = $request->uuidClient;
            $clients->user_id = $request->id;
            $clients->save();

            if ($clients) {
                $clients = Client::where('id_entreprise', $request->id_entreprise)->latest();

                return response()->json($clients);
            }
        } catch (\Exception $exception) {
            die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return response()->json(['message' => 'Apporteur non enregistré'], 422);
        }
    }

    public function editClient($id_client)
    {
        $clients = Client::findOrFail($id_client);
        return response()->json($clients);
    }

    public function updateClient(Request $request, $id_client)
    {
        $clients = Client::find($id_client);
        $clients->civilite = request('civilite');
        $clients->nom_client = request('nom_client');
        $clients->postal_client = request('postal_client');
        $clients->adresse_client = request('adresse_client');
        $clients->tel_client = request('tel_client');
        $clients->profession_client = request('profession_client');
        $clients->fax_client = request('fax_client');
        $clients->email_client = request('email_client');
        $clients->save();

        if ($clients) {
            $clients = Client::where('id_entreprise', $request->id_entreprise)->latest()->paginate(10);

            return response()->json($clients);
        }
    }

    public function getClient()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $clients = Client::select('uuidClient', 'adresse_client', 'civilite', 'email_client', 'fax_client', 'id_entreprise', 'nom_client', 'numero_client', 'postal_client', 'profession_client', 'supprimer_client', 'sync', 'tel_client','user_id')
            ->where('id_entreprise', $user->id_entreprise)->get();

        return response()->json($clients);
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
}
