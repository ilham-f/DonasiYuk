<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'password' => ['required', 'max:45'],
            'password_confirmation' => ['required', 'same:password']
        ]);
        // dd($validated);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        event(new Registered($user));
        auth()->login($user);

        return redirect()->route('verification.notice')->with('alert', 'Pendaftaran berhasil. Mohon verifikasi akun anda terlebih dahulu');
    }
}
