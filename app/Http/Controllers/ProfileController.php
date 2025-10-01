<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
 
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();


        $user->fill($request->validated());
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

   
        if ($request->hasFile('photo')) {
      
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->foto = $path;
        }

        $user->save();


        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Profil berhasil diperbarui!');
        } elseif ($user->role === 'dokter') {
            return redirect()->route('dokter.dashboard')->with('success', 'Profil berhasil diperbarui!');
        } elseif ($user->role === 'pasien') {
            return redirect()->route('pasien.dashboard')->with('success', 'Profil berhasil diperbarui!');
        }

      
        return redirect()->route('home')->with('success', 'Profil berhasil diperbarui!');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }

      
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Akun berhasil dihapus.');
    }
}
