<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email:rfc,dns', 'unique:users'],
            'alamat' => ['required'],
            'password' => ['required', 'max:45'],
            'password_confirmation' => ['required', 'same:password']

        ]);
        // dd($validated);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        return redirect('/')->with('alert', 'Pendaftaran berhasil. Silahkan masuk!');

    }
}
