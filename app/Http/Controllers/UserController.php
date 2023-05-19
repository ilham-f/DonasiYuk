<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Program;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function programku(){
        $userid = Auth::user()->id;
        $myprogram = Program::join('program_images', 'programs.id', '=', 'program_images.program_id')->select('programs.*', 'program_images.*')->where('programs.user_id','=',$userid)->get();
        // $image = ProgramImage::where('mainImage','=','1');
        dd($myprogram);
        return view('user.myprogram', [
            'myprogram' => $myprogram,
            'users' => User::all(),
        ]);
    }

    public function profile(){
        $userid = Auth::user()->id;
        $user = User::find($userid);
        return view('user.profile-page', [
            'user' => $user,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->nama = $request->input('nama');
        $user->email = $request->input('email');
        $user->notelp = $request->input('notelp');
        $user->alamat = $request->input('alamat');
        $user->jk = $request->input('jk');
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
