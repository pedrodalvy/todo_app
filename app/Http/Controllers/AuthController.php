<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    private $authService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->authService = $authService;
    }

    /**
     * Get a JWT via given credentials.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request)
    {
        try {
            return $this->authService->getAccessToken($request);

        } catch (\Exception $exception) {
            return response()->json([
                'mesage' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Get the authenticated User.
     *
     * @return UserResource|JsonResponse
     */
    public function me()
    {
        try {
            $me = $this->authService->aboutMe();
            return new UserResource($me);

        } catch (\Exception $exception) {
            return response()->json([
                'mesage' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout()
    {
        try {
            $this->authService->revokeToken();
            return response()->json([
                'message' => 'Desconectado com sucesso'
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'mesage' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        try {
            return $this->authService->refreshToken();

        } catch (\Exception $exception) {
            return response()->json([
                'mesage' => $exception->getMessage()
            ], 400);
        }
    }
}