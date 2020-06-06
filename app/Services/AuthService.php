<?php

namespace App\Services;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Lang;
use Validator;

class AuthService
{
    use AuthenticatesUsers;

    /**
     * @param Request $request
     * @return array|JsonResponse
     * @throws ValidationException
     */
    public function getAccessToken(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        return $this->responseToken(Auth::guard('api')->attempt($credentials));
    }

    protected function credentials(Request $request)
    {
        $data = $request->only($this->username(), 'password');
        $usernameKey = $this->usernameKey();

        $data[$usernameKey] = $data[$this->username()];

        if ($this->usernameKey() === 'email') {
            unset($data[$this->username()]);
        }

        return $data;
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Check if the login is with email or username
     *
     * @return string
     */
    protected function usernameKey()
    {
        $email = \Request::get($this->username());

        $validator = Validator::make([
            'email' => $email
        ], [
            'email' => 'email'
        ]);

        return $validator->fails() ? 'username' : 'email';
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refreshToken()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
        ]);
    }

    public function revokeToken()
    {
        auth()->logout();
    }

    public function aboutMe()
    {
        return auth()->user();
    }

    private function responseToken($token)
    {
        return $token ? ['token' => $token] :
            response()->json([
                'error' => Lang::get('auth.failed'),
            ], 400);
    }
}