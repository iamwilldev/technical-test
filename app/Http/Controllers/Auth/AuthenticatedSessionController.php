<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // activity()->causedBy(Auth::user())
        // ->on(Auth::user())
        // ->withProperties(['attributes' => Auth::user()->toArray()])
        // ->event('login')
        // ->log('Logged in ' . Auth::user()->name . ' successfully');

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // activity()->causedBy(Auth::user())
        // ->on(Auth::user())
        // ->withProperties(['attributes' => Auth::user()->toArray()])
        // ->event('login')
        // ->log('Logged out ' . Auth::user()->name . ' successfully');
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
