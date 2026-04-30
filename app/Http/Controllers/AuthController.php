<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyLoginOtpRequest;
use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    public function register(RegisterRequest  $request)
    {
        return response()->json(
            $this->authService->registerFromRequest($request),
            201
        );
    }

    public function login(LoginRequest $request)
{
    return response()->json(
        $this->authService->login($request->validated())
    );
}

public function verifyLoginOtp(VerifyLoginOtpRequest $request)
{
    return response()->json(
        $this->authService->verifyLoginOtp($request->validated())
    );
}


public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $response = $this->authService->forgetPassword($request->email);

        return response()->json($response);
    }


public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'code' => ['required', 'digits:6'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);

        $response = $this->authService->resetPassword($request->all());

        return response()->json($response);
    }

    public function logout(Request $request)
    {
        return response()->json(
            $this->authService->logout($request)
        );
    }

    public function logoutAll(User $user)
    {
        return response()->json(
            $this->authService->logoutAll($user)
        );
    }



}