<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Branche;
use App\Models\Activite;
use App\Models\Compagnie;
use App\Models\Entreprise;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TauxCompagnie;
use Illuminate\Support\Facades\Hash;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entreprises = Entreprise::all();

        return response()->json($entreprises);
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
        dd($request->all());
        // //validation
        // $rules = [
        //     'nom' => 'required',
        //     'email' => 'required',
        //     'contact' => 'required',
        //     'adresse' => 'required',
        // ];

        // $customMessages = [
        //     'nom.required' => 'Veuillez entrer le nom du client',
        //     'email.required' => 'Veuillez entrer le contact du client',
        //     'contact.required' => 'Veuillez entrer un contact de 10 chiffres',
        //     'adresse.required' => 'Veuillez entrer une adresse',
        // ];

        // $this->validate($request, $rules, $customMessages);

        // $entreprise = $request->nom;
        // if (Entreprise::where('nom', '=', $entreprise)->count() > 0) {
        //     return response()->json(['message' => 'Entreprise existante'], 422);
        // } else {
        //     $now = date('Y-m-d');

        //     $client = new Entreprise();
        //     $client->nom = $request->nom;
        //     $client->contact = $request->contact;
        //     $client->email = $request->email;
        //     $client->adresse = $request->adresse;
        //     $client->statut = 0;
        //     $client->date_demande = $now;
        //     $client->save();

        //     //redirection
        //     return back()->with('success', 'Votre demande à été enregistré avec succès. Nous entamons le traitement de votre demande');
        // }
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
    public function edit($id_entreprise)
    {
        $entreprises = Entreprise::findOrFail($id_entreprise);
        return response()->json($entreprises);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_entreprise)
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

    public function postRegistration(Request $request)
    {
        // //validation
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',
            'adresse' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Veuillez entrer le nom du client',
            'email.required' => 'Veuillez entrer le contact du client',
            'contact.required' => 'Veuillez entrer un contact de 10 chiffres',
            'adresse.required' => 'Veuillez entrer une adresse',
        ];

        $this->validate($request, $rules, $customMessages);

        $entreprise = $request->name;
        $email = $request->email;
        if (Entreprise::where('nom', '=', $entreprise)->count() > 0) {
            return response()->json(['message' => 'Entreprise existante'], 423);
        }

        if (Entreprise::where('email', '=', $email)->count() > 0) {
            return response()->json(['message' => 'Email existant'], 423);
        }


        $now = date('Y-m-d');

        $client = new Entreprise();
        $client->nom = $request->name;
        $client->contact = $request->contact;
        $client->email = $request->email;
        $client->adresse = $request->adresse;
        $client->statut = 0;
        $client->date_demande = $now;
        $client->save();

        return response()->json($client);

        //redirection
        // Votre demande à été enregistré avec succès. Nous entamons le traitement de votre demande
    }

    public function validateEntreprise(Request $request)
    {
        $id_entreprise = $request->entreprise;


        // Validation de l'entreprise
        Entreprise::where('id_entreprise', $id_entreprise)->update(['statut' => 1]);

        // Creation d'un utilisateur
        $random_password = "12345678";

        //Création de l'administrateur de l'entreprise
        $user = new User();
        $user->name = $request->nom;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->adresse = $request->adresse;
        $user->id_entreprise = $id_entreprise;
        $user->id_role = 2;
        $user->password = Hash::make($random_password);
        $user->save();

        $branches = [
            "AUTOMOBILE", "MOTO", "RC DIVERSES", "RC EXPLOITATION", "RC ENTREPRISE", "RC ASSOCIATION SPORTIVE", "RC PROFESSIONNELLE", "TRANSPORT", "RC PLAISANCE", "MULTIRISQUE PLAISANCE",
            "MARCHANDISES TRANSPORTEES", "CORPS FLUVIAUX", "MALADIE GROUPE", "MALADIE PARTICULIER", "ASSISTANCE", "TOUS RISQUES SAUF", "GLOBALES DOMMAGES", "MULTIRISQUE IMMEUBLE",
            "MULTIRISQUE HABITATION", "MULTIRISQUE PROFESSIONELLE", "MULTIRISQUE BUREAUX", "TOUS RISQUE CHANTIER", "RC DECENNALE", "TOUS RISQUE MATERIELS", "ENGINS DE CHANTIERS", "BRIS DE MACHINES"
        ];

        for ($i = 0; $i < count($branches); $i++) {
            $branche = new Branche();
            $branche->uuidBranche = Uuid::uuid4()->toString();
            $branche->nom_branche = $branches[$i];
            $branche->sync = 1;
            $branche->id_entreprise = $id_entreprise;
            $branche->save();
        }


        // // Envoie de mail
        // $to_email = $request->email;

        // // envoi de mail
        // if ($request->isMethod('post')) {
        //     $data = $request->all();

        //     $data = array(
        //         "body" => "Notification de création de compte",
        //         'email' => $data['email'],
        //         'password' => $random_password,
        //         'entreprise' => $data['nom'],
        //     );

        //     Mail::send('emails.users', $data, function ($message) use ($to_email) {
        //         $message->to($to_email)
        //             ->subject('Création de compte');
        //         $message->from('flairapplication@gmail.com', 'FLAIR');
        //     });
        // }
    }

    public function tarificationEntreprise(Request $request)
    {
        $id_entreprise = $request->entreprise;

        $tarifications = [
            ['classe' => '1', 'activite' => 'Personnes sans profession'],
            ['classe' => '1', 'activite' => 'Emploi administratif de bureau'],
            ['classe' => '1', 'activite' => 'Professions libérales (Notaires ; Avocats ; Huissier de justice)'],
            ['classe' => '1', 'activite' => 'Enseignants de l\'enseignement non technique'],
            ['classe' => '2', 'activite' => 'Répresentant de commerce'],
            ['classe' => '2', 'activite' => 'Couturiers'],
            ['classe' => '2', 'activite' => 'Commerçants (sans travail manuel)'],
            ['classe' => '2', 'activite' => 'Dépaneurs'],
            ['classe' => '2', 'activite' => 'Marchands ambulants'],
            ['classe' => '2', 'activite' => 'Agents ou personnel non sédentaire d\'assurance, de banque etc'],
            ['classe' => '2', 'activite' => 'Agents de recouvrement'],
            ['classe' => '2', 'activite' => 'Coiffeurs'],
            ['classe' => '2', 'activite' => 'Acteurs (cinéma, Théatre …)'],
            ['classe' => '2', 'activite' => 'Professions médicales et para-médicales'],
            ['classe' => '3', 'activite' => 'Artisans (emploi de matériels lourds ou encombrants)'],
            ['classe' => '3', 'activite' => 'Mécaniciens'],
            ['classe' => '3', 'activite' => 'Chimiste'],
            ['classe' => '3', 'activite' => 'Boulanger'],
            ['classe' => '3', 'activite' => 'Patissier'],
            ['classe' => '3', 'activite' => 'Imprimeur'],
            ['classe' => '3', 'activite' => 'Quicailliers'],
            ['classe' => '3', 'activite' => 'Sculpteurs'],
            ['classe' => '3', 'activite' => 'Enseignants de l\'enseignement technique'],
            ['classe' => '3', 'activite' => 'Directeurs avec circulation dans les ateliers'],
            ['classe' => '4', 'activite' => 'Bâtiments et travaux publics'],
            ['classe' => '4', 'activite' => 'Constructions navales'],
            ['classe' => '4', 'activite' => 'Industrie (sauf travail du bois)'],
            ['classe' => '4', 'activite' => 'Agriculteurs, épouses des exploitants agricoles et leurs salariés'],
            ['classe' => '4', 'activite' => 'Déménageurs'],
            ['classe' => '4', 'activite' => 'Professions annexes à l\'agriculture (éleveurs, Vétérinaires …)'],
            ['classe' => '4', 'activite' => 'Conducteurs d\'engins de chantier'],
            ['classe' => '4', 'activite' => 'Conducteurs d\'engins de levage'],
            ['classe' => '4', 'activite' => 'Conducteurs de Véhicules de transport publics'],
            ['classe' => '4', 'activite' => 'Manutentionnaires'],
            ['classe' => '4', 'activite' => 'Livreurs'],
            ['classe' => '5', 'activite' => 'Travaux en hauteur y compris échafaudages'],
            ['classe' => '5', 'activite' => 'Installation et entretien d\'ascenseurs'],
            ['classe' => '5', 'activite' => 'Peintures en bâtiment'],
            ['classe' => '5', 'activite' => 'Personnes travaillant dans les abattoirs'],
            ['classe' => '5', 'activite' => 'Service de maintien de l\'ordre (police gendarmerie, garde pénitentiaire …)'],
            ['classe' => '5', 'activite' => 'Travail manuel en docks et entrepôts (dockers)'],
            ['classe' => '5', 'activite' => 'Ouvriers de carrières'],
            ['classe' => '5', 'activite' => 'Mise en œuvre de moyens de secours contre l\'incendie et autres catastrophes'],
            ['classe' => '6', 'activite' => 'Travail du bois (menuiserie; scierie …)'],
            ['classe' => '7', 'activite' => 'Électriciens sur haute tension'],
            ['classe' => '7', 'activite' => 'Pêche ou autres travaux en mer'],
            ['classe' => '7', 'activite' => 'Travaux souterrains (extractions; fouilles …)'],
            ['classe' => '8', 'activite' => 'Abattage d\'arbres'],
            ['classe' => '8', 'activite' => 'Travail sur toits (couvertures, poseurs d\'antennes …)'],
            ['classe' => '8', 'activite' => 'Démolitions d\'immeubles'],
            ['classe' => '8', 'activite' => 'Constructions portuaires, d\'ouvrages d\'art, de barrages …)'],
            ['classe' => '8', 'activite' => 'Manipulation d\'explosifs'],
            ['classe' => '8', 'activite' => 'Mines'],
            ['classe' => '8', 'activite' => 'Ouvriers de sociétés d\'élagage'],
        ];

        for ($i = 0; $i < count($tarifications); $i++) {
            $tarification = new Activite();
            $tarification->uuidActivite = Uuid::uuid4()->toString();
            $tarification->activite = $tarifications[$i]['activite'];
            $tarification->classe = $tarifications[$i]['classe'];
            $tarification->sync = 1;
            $tarification->id_entreprise = $id_entreprise;
            $tarification->save();
        }
    }
}
