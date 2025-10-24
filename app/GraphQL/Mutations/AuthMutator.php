<?php

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthMutator
{
    public function login(null $_, array $args): array
    {
        $credentials = [
            'email'    => $args['email'],
            'password' => $args['password'],
        ];

        if (!$token = Auth::guard('api')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        return $this->respondWithToken($token);
    }

    public function refresh(): array
    {
        $token = Auth::guard('api')->refresh();
        return $this->respondWithToken($token);
    }

    public function logout(): bool
    {
        Auth::guard('api')->logout();
        return true;
    }

    private function respondWithToken(string $token): array
    {
        $user = Auth::guard('api')->user();

        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60,
            'user'         => $user,
        ];
    }
}
