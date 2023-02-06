<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;



class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            dd($user_google);
            $user           = User::where('email', $user_google->getEmail())->first();

            //jika user ada maka langsung di redirect ke halaman home
            //jika user tidak ada maka simpan ke database
            //$user_google menyimpan data google account seperti email, foto, dsb

            if($user != null){
                Auth::login($user);
                return redirect()->intended('/');
            }else{
                $create = User::Create([
                    'email'             => $user_google->getEmail(),
                    'nama'              => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now()
                ]);

                Auth::login($create);
                return redirect()->intended('/');
            }

        }
        catch (\Exception $e) {
            return redirect()->intended('/');
        }
    }
}
