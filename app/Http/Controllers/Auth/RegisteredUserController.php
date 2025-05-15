<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View|RedirectResponse
    {
        if (Auth::check()) {
            if (session('needs_profiling', false)) {
                return redirect()->route('create_user_profiling.index', ['account_id' => Auth::id()]);
            }
            return redirect()->route('dashboard');
        }
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Account::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $account = Account::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($account));

        Auth::login($account);

        // return redirect(route('dashboard', absolute: false));

        session(['needs_profiling' => true]);
        // Redirect to user-profiling with account_id
        return redirect()->route('create_user_profiling.index', ['account_id' => $account->id]);
    }
}
