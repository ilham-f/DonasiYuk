<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\Program;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDonasiRequest;
use App\Http\Requests\UpdateDonasiRequest;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $program = Program::find($id);
        return view('user.form-donasi',[
            'program' => $program,
        ]);
    }

    public function showMore(Request $request) {
        // Retrieve the starting index for the doa
        $start = $request->start;
        $program_id = $request->program_id;

        $donasis = Donasi::join('users','users.id','=','donasis.user_id')->select('donasis.*', 'users.nama',)->where('program_id','=',$program_id)->get();
        // Retrieve the next batch of doa from the database or any other data source
        $doa = $donasis->slice($start)->take(3);
        $arr = [(count($donasis)-$start), $doa];

        // Return the doa as a response
        return $arr;
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
     * @param  \App\Http\Requests\StoreDonasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonasiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donasi  $Donasi
     * @return \Illuminate\Http\Response
     */
    public function show(Donasi $Donasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donasi  $Donasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Donasi $Donasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDonasiRequest  $request
     * @param  \App\Models\Donasi  $Donasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDonasiRequest $request, Donasi $Donasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donasi  $Donasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donasi $Donasi)
    {
        //
    }
}
