<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL(),
            'name' => auth()->user()->name,
            'user_id' => auth()->user()->id,
            'email' => auth()->user()->email,
            'contact' => auth()->user()->contact,
            'adresse' => auth()->user()->adresse,
            'id_entreprise' => auth()->user()->id_entreprise,
            'role' =>  User::join("roles", 'users.id_role', '=', 'roles.id_role')->where('users.id', auth()->user()->id)->value('nom_role'),
            'mode' =>  User::join("entreprises", 'users.id_entreprise', '=', 'entreprises.id_entreprise')->where('users.id', auth()->user()->id)->value('mode'),
        ]);
    }

    public function userProfile()
    {
        $user = User::select('*')->where('users.id', '=', auth()->user()->id)
            ->get();

        return response()->json([
            'success' => true,
            // 'message' => 'Veuillez vérifier votre messagerie pour terminer.',
            'user' => $user
        ], Response::HTTP_OK);
    }

    public function checkToken(Request $request)
    {
        try {
            $token = $request->input('token');

            // Verify the token
            JWTAuth::setToken($token)->checkOrFail();

            return response()->json(['valid' => true], 200);
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'Token expired'], 401);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Invalid token'], 401);
        }
    }

    public function validateToken(Request $request)
    {
        try {
            // Si le token est valide, il ne fera rien et passera
            $user = JWTAuth::parseToken()->authenticate();
            return response()->json(['valid' => true, 'user' => $user], 200);
        } catch (\Exception $e) {
            // Si le token n'est pas valide, renvoyer une réponse avec une erreur
            return response()->json(['valid' => false, 'message' => 'Token is invalid'], 401);
        }
    }
}
