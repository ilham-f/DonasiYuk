<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donasi;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function programku(){
        $userid = Auth::user()->id;
        $myprogram = Program::where('user_id','=',$userid)->paginate(5);
        // $image = ProgramImage::where('mainImage','=','1');
        // dd($myprogram);
        return view('user.myprogram', [
            'myprogram' => $myprogram,
            // 'users' => User::all(),
        ]);
    }

    public function totalDonasi(){
        $userid = Auth::user()->id;
        $donasi = Donasi::selectRaw('SUM(jml_donasi) AS totalDonasi')->where('user_id','=',$userid)->first();
        // dd($donasi);
        if ($donasi->totalDonasi) {
            return $donasi->totalDonasi;
        } else {
            return 0;
        }
    }
    public function profile(){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        $donasi = Donasi::selectRaw('SUM(jml_donasi) AS totalDonasi')->where('user_id','=',$userid)->first();
        // dd($donasi);
        return view('user.profile-page', [
            'user' => $user,
            'donasi' => $donasi
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rwytdonasi()
    {
        $mydonasi = Donasi::where('user_id','=',Auth::user()->id)->paginate(5);
        return view('user.rwytdonasi', [
            'mydonasi' => $mydonasi,
        ]);
    }

    public function ubahAnonim(Request $request)
    {
        $isAnonim = [
            'anonim' => $request->isAnonim
        ];

        $user = User::find(Auth::user()->id);
        $user->update($isAnonim);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatepw(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'password_lama' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['required', 'same:password']
        ]);

        if (Hash::check($request->password_lama, $user->password)){
            $user->update(['password' => Hash::make($request->password)]);
            return back()->with('message', 'Password Anda berhasil diubah');
        }

        throw ValidationException::withMessages([
            'password_lama' => 'Password lama Anda tidak valid'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->notelp = $request->notelp;
        $user->alamat = $request->alamat;
        $user->update();

        return redirect('/profile')->with('status', 'Data akun Anda berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
