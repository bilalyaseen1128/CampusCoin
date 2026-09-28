<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Show the combined sign-in / register view.
     * $activePanel tells the view which side to open on and which
     * form's errors/old input to display after a failed submit.
     */
    public function show(Request $request): View
    {
        $activePanel = $request->routeIs('register') ? 'register' : 'login';

        return view('auth', ['activePanel' => $activePanel]);
    }

    /**
     * Handle registration (name, email, password, password_confirmation).
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'academic_year' => null,
            'monthly_allowance_baseline' => 0,
            'monthly_savings_goal' => 0,
            'dark_mode' => 0,
            'font_size' => 'medium',
            'is_active' => 1,
        ]);

        event(new Registered($user));

        Auth::guard('web')->login($user, true);

        $request->session()->regenerate();

        // Sanity check: if for any reason the session didn't pick up the
        // login (e.g. guard/provider mismatch), send the user to login
        // instead of a broken "half logged in" dashboard state.
        if (! Auth::guard('web')->check()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Account created, but we could not sign you in automatically. Please log in.']);
        }

        return redirect()->route('dashboard');
    }

    /**
     * Handle login (email, password).
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'These credentials do not match our records.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}