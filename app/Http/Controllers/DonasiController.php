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
    public function index(Request $request, Program $program, User $user)
    {
        // dd($id);
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Kqwi6_p1y0tQcPN7x_xhns8N';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        // dd($program);
        // dd($user);
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            ),
            'customer_details' => array(
                'first_name' => 'ppp',
                'email' => 'ppp@mail.com',
                'phone' => 'ppp',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('user.form-donasi',[
            'program' => $program,
            'snaptoken' => $snapToken,
            'id' => $user->id
        ]);
    }

    public function galangdana()
    {
        return view('user.form-program');
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
