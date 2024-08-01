<?php

namespace App\Repositories;

use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class ResponseRepository.
 */
class ResponseRepository
{
    /**
     * Respond with a token and data.
     *
     * @param mixed $data
     * @param \Illuminate\Contracts\Auth\Authenticatable $user
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithToken($data, $user, $message)
    {
        $token = JWTAuth::fromUser($user);
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'token' => $token,
        ]);
    }

    /**
     * Respond with data only.
     *
     * @param mixed $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithData($data, $message = '', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Respond with an error.
     *
     * @param string $message
     * @param int $errorCode
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message, $errorCode = 500, $errors = [])
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $errorCode);
    }
}
