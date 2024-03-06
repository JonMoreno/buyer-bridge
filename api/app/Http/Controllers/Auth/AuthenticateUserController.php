<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticateUserController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function login(LoginRequest $request): Response
    {
        $request->authenticate();

        $request->session()->regenerate();

        if (Auth::check()) {
            \Log::debug(Auth::user());
        }

        return response()->noContent();
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }

    /**
     * Retrieve the authenticated user.
     */
    public function user(Request $request): Response
    {
        return response($request->user());
    }
}
