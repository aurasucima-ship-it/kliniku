<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();

        if ($request->hasFile('foto')) {
            // simpan file ke storage/app/public/foto
            $path = $request->file('foto')->store('foto', 'public');
            $user->foto = $path;
        }

        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
