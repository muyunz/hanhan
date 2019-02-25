<?php


namespace App\Services;


class AuthService extends Service
{

    public function loginByCredentials($credentials)
    {
        if (! $token = auth()->attempt($credentials)) {
            return false;
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }

}
