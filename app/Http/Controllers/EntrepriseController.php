<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branche;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; 

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
    // public function update(Request $request, $id_entreprise)
    // {
    //     // dd($id_entreprise);
    //     // Validation de l'entreprise
    //     Entreprise::where('id_entreprise', $id_entreprise)->update(['statut' => 1]);

    //     // Creation d'un utilisateur
    //     $random_password = "12345678";

    //     //Création de l'administrateur de l'entreprise
    //     $user = new User();
    //     $user->name = $request->nom;
    //     $user->email = $request->email;
    //     $user->contact = $request->contact;
    //     $user->adresse = $request->adresse;
    //     $user->id_entreprise = $id_entreprise;
    //     $user->id_role = 2;
    //     $user->password = Hash::make($random_password);
    //     $user->save();

    //     $branches = [
    //         "AUTOMOBILE", "MOTO", "RC DIVERSES", "RC EXPLOITATION", "RC ENTREPRISE", "RC ASSOCIATION SPORTIVE","RC PROFESSIONNELLE", "TRANSPORT", "RC PLAISANCE", "MULTIRISQUE PLAISANCE",
    //         "MARCHANDISES TRANSPORTEES", "CORPS FLUVIAUX", "MALADIE GROUPE", "MALADIE PARTICULIER", "ASSISTANCE", "TOUS RISQUES SAUF", "GLOBALES DOMMAGES", "MULTIRISQUE IMMEUBLE",
    //         "MULTIRISQUE HABITATION", "MULTIRISQUE PROFESSIONELLE", "MULTIRISQUE BUREAUX", "TOUS RISQUE CHANTIER", "RC DECENNALE", "TOUS RISQUE MATERIELS", "ENGINS DE CHANTIERS", "BRIS DE MACHINES"
    //     ];

    //     for ($i = 0; $i < count($branches); $i++) {
    //         $branche = new Branche();
    //         $branche->nom_branche = $branches[$i];
    //         $branche->sync = 1;
    //         $branche->id_entreprise = $id_entreprise;
    //         $branche->save();
    //     }

    //     // Créer les compagnies
    //     // $path = 'Classeur1.csv';
    //     // $handle = fopen($path, "r"); // open in readonly mode
    //     // fgetcsv($handle);

    //     // $day = date('d');
    //     // $month = date('m');
    //     // $year = date('Y');
    //     // $a = substr($request->nom, 0, 3);
    //     // $ref = $a . '-'  . intval($month) . intval($day) . $year;



    //     // // Parse data from CSV file line by line
    //     // while (($getData = fgetcsv($handle, 10000, ",")) !== FALSE) {

    //     //     $id = (int)$id_entreprise;
    //     //     // dd($id);

    //     //     // if (is_string($getData[0])){
    //     //     //     dd($id);
    //     //     // }
    //     //     // is_float() - Détermine si une variable est de type nombre décimal
    //     //     // is_int() - Détermine si une variable est de type nombre entier
    //     //     // is_bool() - Détermine si une variable est un booléen
    //     //     // is_object() - Détermine si une variable est de type objet
    //     //     // is_array() - Détermine si une variable est un tableau
    //     //     // is_numeric() - Détermine si

    //     //     $pcreate_data[] =
    //     //         array(
    //     //             'nom_compagnie' => $getData[0],
    //     //             'email_compagnie' => $getData[1],
    //     //             'adresse_compagnie' => $getData[2],
    //     //             'contact_compagnie' => $getData[3],
    //     //             'postal_compagnie' => $getData[4],
    //     //             'code_compagnie' => $ref,
    //     //             'id_entreprise' =>  $request->entreprise,

    //     //         );
    //     // }

    //     // foreach ($pcreate_data as $data) {
    //     //     Compagnie::create($data);
    //     // }

    //     // fclose($handle);



    //     //Recuperer les permissions du rôle
    //     // $id = Compagnie::select('id_compagnie')
    //     //     ->where('id_entreprise', $id_entreprise)
    //     //     ->get()
    //     //     ->toArray();

    //     // // dd($id);
    //     // foreach ($id as $get) {
    //     //     $azerty[] = $get->id_compagnie;
    //     // }

    //     // // Ajout des permissions
    //     // for ($i = 0; $i < count($azerty); $i++) {
    //     //     $assoc = new TauxCompagnie();
    //     //     $assoc->id_branche = $id;
    //     //     $assoc->id_compagnie = $azerty[$i];
    //     //     $assoc->tauxcomp = 0;
    //     //     $assoc->save();
    //     // }



    //     // // Envoie de mail
    //     // $to_email = $request->email;

    //     // // envoi de mail
    //     // if ($request->isMethod('post')) {
    //     //     $data = $request->all();

    //     //     $data = array(
    //     //         "body" => "Notification de création de compte",
    //     //         'email' => $data['email'],
    //     //         'password' => $random_password,
    //     //         'entreprise' => $data['nom'],
    //     //     );

    //     //     Mail::send('emails.users', $data, function ($message) use ($to_email) {
    //     //         $message->to($to_email)
    //     //             ->subject('Création de compte');
    //     //         $message->from('flairapplication@gmail.com', 'FLAIR');
    //     //     });
    //     // }
    // }


    const DEFAULT_PASSWORD = "12345678";
    const ADMIN_ROLE_ID = 2;

    public function update(Request $request, $id_entreprise)
    {
        try {
            $this->updateEntreprise($id_entreprise);
            $user = $this->createUser($request, $id_entreprise);
            $this->createBranches($id_entreprise);
            // Uncomment the following lines if you have additional logic

            // $this->createCompagnies($id_entreprise);
            // $this->sendEmailNotification($user);

        } catch (\Exception $e) {
            // Handle exceptions, log errors, or provide feedback to the user.
            // Consider rolling back any changes made within the transaction.
        }
    }

    private function updateEntreprise($id_entreprise)
    {
        Entreprise::where('id_entreprise', $id_entreprise)->update(['statut' => 1]);
    }

    private function createUser(Request $request, $id_entreprise)
    {
        $user = new User();
        $user->name = $request->nom;
        $user->email = $request->email;
        $user->contact = $request->contact;
        $user->adresse = $request->adresse;
        $user->id_entreprise = $id_entreprise;
        $user->id_role = self::ADMIN_ROLE_ID;
        $user->password = Hash::make(self::DEFAULT_PASSWORD);
        $user->save();

        return $user;
    }

    private function createBranches($id_entreprise)
    {
        $branches = [
            "AUTOMOBILE", "MOTO", "RC DIVERSES", "RC EXPLOITATION", "RC ENTREPRISE", "RC ASSOCIATION SPORTIVE", "RC PROFESSIONNELLE",
            "TRANSPORT", "RC PLAISANCE", "MULTIRISQUE PLAISANCE", "MARCHANDISES TRANSPORTEES", "CORPS FLUVIAUX", "MALADIE GROUPE",
            "MALADIE PARTICULIER", "ASSISTANCE", "TOUS RISQUES SAUF", "GLOBALES DOMMAGES", "MULTIRISQUE IMMEUBLE",
            "MULTIRISQUE HABITATION", "MULTIRISQUE PROFESSIONELLE", "MULTIRISQUE BUREAUX", "TOUS RISQUE CHANTIER", "RC DECENNALE",
            "TOUS RISQUE MATERIELS", "ENGINS DE CHANTIERS", "BRIS DE MACHINES"
        ];

        foreach ($branches as $branch) {
            $branche = new Branche();
            $branche->nom_branche = $branch;
            $branche->uuid = Str::uuid(); // Generate UUID using Laravel's Str class
            $branche->sync = 1;
            $branche->id_entreprise = $id_entreprise;
            $branche->save();
        }
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
}
