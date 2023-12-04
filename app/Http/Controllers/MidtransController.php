<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\User;
use App\Models\Program;
use App\Models\Donasi;
use Midtrans\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MidtransController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newToken(Request $request)
    {
        // dd($request);
        $program = Program::find($request->programid);
        $user = User::find($request->userid);
        $doa = $request->doa;
        $userNama = $user->nama;
        $userEmail = $user->email;
        $userTelp = $user->notelp;
        $programJudul = $program->judul;
        \Midtrans\Config::$serverKey = 'SB-Mid-server-Kqwi6_p1y0tQcPN7x_xhns8N';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->jmldonasi,
            ),
            'customer_details' => array(
                'judul' => $programJudul,
                'first_name' => $userNama,
                'email' => $userEmail,
                'phone' => $userTelp,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        // dd($program);
        return view('user.pembayaran',[
            'program' => $program,
            'snapToken' => $snapToken
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dana = $request->dana;
        $bank = $request->bank;
        $va = $request->va;
        $id_bayar = $request->id_bayar;

        $getProgram = Program::join('donasis','donasis.program_id','=','programs.id')->select('donasis.program_id')->where('donasis.id_pembayaran','=',$id_bayar)->first();
        $getDonasi = Donasi::where('id_pembayaran','=',$id_bayar)->first();

        $program_id =  $getProgram->program_id;
        $donasi_id =  $getDonasi->id;

        $program = Program::find($program_id);
        $donasi = Donasi::find($donasi_id);

        $danaterkumpul = $program->danaterkumpul + $dana;
        $program->update([
            'danaterkumpul' => $danaterkumpul
        ]);

        $donasi->update([
            'bank' => $bank,
            'va' => $va,
            'status' => 1,
        ]);

        return 'Update berhasil!';
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
