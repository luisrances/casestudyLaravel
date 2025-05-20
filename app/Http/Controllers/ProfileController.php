<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the account's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'account' => Auth::user(),
        ]);
    }

    /**
     * Update the account's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->account()->fill($request->validated());

        if ($request->account()->isDirty('email')) {
            $request->account()->email_verified_at = null;
        }

        $request->account()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the account's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('accountDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $account = $request->account();

        Auth::logout();

        $account->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
