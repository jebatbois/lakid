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
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Validasi Manual untuk field tambahan (atau update ProfileUpdateRequest jika mau)
        $request->validate([
            'no_ktp' => ['required', 'string', 'max:20'],
            'no_hp' => ['required', 'string', 'max:20'],
            'alamat_ktp' => ['required', 'string', 'max:500'],
        ]);

        $request->user()->fill($request->validated());
        
        // Simpan field tambahan manual karena fill() di atas mungkin dibatasi oleh rules default ProfileUpdateRequest
        $request->user()->no_ktp = $request->no_ktp;
        $request->user()->no_hp = $request->no_hp;
        $request->user()->alamat_ktp = $request->alamat_ktp;

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}