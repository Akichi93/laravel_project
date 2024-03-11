<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Prospect;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =  JWTAuth::parseToken()->authenticate();
        $users = User::join("roles", 'roles.id_role', '=', 'users.id_role')
            // ->where('id_entreprise', $user->id_entreprise)
            ->get();

        return response()->json($users);
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
        // //validation
        $rules = [
            'name' => 'required',
            'contact' => 'required|digits:10',
            'email' => 'required',
            'adresse' => 'required',
            'password' => 'required',
        ];

        $customMessages = [
            'name.required' => 'Entrez le nom svp',
            'email.required' => 'Veuillez entrer le contact de l\'apporteur',
            'contact.digits' => 'Veuillez entrer un contact de 10 chiffres',
            'contact.required' => 'Veuillez entrer un numéro',
            'adresse.required' => 'Veuillez entrer une adresse',
            'password.required' => 'Veuillez entrer un ùot de passe',
        ];

        $this->validate($request, $rules, $customMessages);

        // Encodage
        // Génération du mot de passe


        try {
            $user =  JWTAuth::parseToken()->authenticate();

            $users = new User();
            $users->name = $request->name;
            $users->email = $request->email;
            $users->password = Hash::make($request->password);
            $users->contact = $request->contact;
            $users->adresse = $request->adresse;
            $users->id_role = $request->poste;
            $users->id_entreprise = $user->id_entreprise;
            $users->save();

            // $to_email = $request->email;

            // // envoi de mail
            // if ($request->isMethod('post')) {
            //     $data = $request->all();

            //     $data = array(
            //         "body" => "Notification de création de projet",
            //         'email' => $data['email'],
            //         'password' => $random_password,
            //     );

            //     Mail::send('emails.users', $data, function ($message) use ($to_email) {
            //         $message->to($to_email)
            //             ->subject('Création de compte');
            //         $message->from('appliecommerce@gmail.com', 'FLAIR');
            //     });
            // }
            if ($users) {

                $users = User::join("roles", 'roles.id_role', '=', 'users.id_role')
                    // ->where('id_entreprise', $user->id_entreprise)
                    ->get();
                // dd($users);

                return response()->json($users);
            }
        } catch (\Exception $exception) {
            die("Impossible de se connecter à la base de données.  Veuillez vérifier votre configuration. erreur:" . $exception);
            return response()->json(['message' => 'Apporteur non enregistré'], 422);
        }
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
    public function edit($id)
    {
        $users = User::findOrFail($id);
        return response()->json($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->contact = request('contact_user');
        $user->save();
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

    public function getLogs(Request $request)
    {
        $users = User::join("roles", 'roles.id_role', '=', 'users.id_role')
            ->where('id', $request->user)
            ->first();

        $prospects = Prospect::where('user_id', $request->user)
            ->where('etat', 0)
            ->get();

        $clients = Client::where('user_id', $request->user)
            ->get();

        return response()->json(["users" => $users, "prospects" => $prospects, "clients" => $clients]);
    }

    public function getRole()
    {
        $roles = User::join("roles", 'roles.id_role', '=', 'users.id_role')->where('id', Auth::user()->id)
            ->pluck('nom_role');

        return response()->json($roles);
    }

    public function changepassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'newpassword' => 'required',
        ]);

        $user =  JWTAuth::parseToken()->authenticate();

        $hashedPassword = $user->password;

        if (Hash::check($request->oldpassword, $hashedPassword)) {

            if (!Hash::check($request->newpassword, $hashedPassword)) {

                $users = User::find($user->id);
                $users->password = bcrypt($request->newpassword);
                User::where('id', $user->id)->update(array('password' => $users->password));

                return response()->json(['message' => 'Adresse existante'], 200);
            } else {
                return response()->json(['message' => 'Le nouveau mot de passe ne peut pas être l\'ancien mot de passe !'], 422);
            }
        } else {

            return response()->json(['message' => 'L\'ancien mot de passe ne correspond pas'], 401);
        }
    }
}
