<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

class MailController extends Controller
{

    public function verify()
    {
        return view('verification');
    }

    public function handler(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/')->with('success', 'Akun anda telah berhasil diverifikasi!');
    }

    public function resend(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect('/')->with('success', 'Akun anda telah berhasil diverifikasi!');
        }

        $user->sendEmailVerificationNotification();

        return back()->with('success', 'Link verifikasi telah dikirim ulang!');
    }

    // public function lupaPw()
    // {
    //     return view('user.home-page')->with('reset','Kami telah mengirimkan link reset password');
    // }

    public function resetEmail(Request $request)
    {
        $request->validate([
            'email' => ['required','exists:users,email']
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'Kami telah mengirimkan link Reset Password ke email anda!'])
                    : back()->withErrors(['email' => __($status)]);
    }

    public function resetView($token)
    {
        return view('reset-password', [
            'token' => $token
        ]);
    }

    public function resetPw(Request $request)
    {
        // dd($request);
        $request->validate([
            'token' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect('/')->with('reseted', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
