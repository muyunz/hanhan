<?php


namespace App\Http\Controllers;


use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        if(! $tokenInfo = $this->authService->loginByCredentials($request->credentials())) {
            abort(401, '帳號或密碼錯誤');
        };
        return $this->respondJson($tokenInfo);
    }

}
