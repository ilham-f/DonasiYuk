<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Obat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = auth()->user()->id;
        $cartItems = \Cart::session($userid)->getContent();
        return view('user.riwayatpembelian', [
            'title' => 'Pesanan Saya',
            'cart' => $cartItems,
            'users' => User::all(),
            'transaksi' => Transaksi::where('user_id', '=', $userid)->latest()->paginate(2)
        ]);
    }

    public function indexadmin()
    {
        return view('admin.riwayattransaksi', [
            'transaksi' => Transaksi::latest()->paginate(2),
            'title' => 'Riwayat Transaksi'
        ]);
    }

    public function getSumTransaksi()
    {
        $result = Transaksi::sum('total_harga');
        return view('admin.admin', [
            'jumlahpemasukan' => $result,
            'title' => 'Home'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function buat(Request $request)
    {

        $userid = auth()->user()->id;

        Transaksi::create([
            'user_id' => $userid,
            'jumlah_barang' => \Cart::session($userid)->getTotalQuantity(),
            'total_harga' => \Cart::session($userid)->getTotal(),
            'tanggal' => Carbon::now()->translatedFormat('d F Y'),
            'jam' => Carbon::now()->format('H:i'),
            'alamat' => auth()->user()->alamat
        ]);

        $transaksi = Transaksi::latest('id')->first();

        $cartItems = \Cart::session($userid)->getContent();

        // dd($cartItems);

        foreach ($cartItems as $obat) {
            $transaksi->obats()->attach($obat->id, ['qty' => $obat->quantity, 'pricesum' => $obat->getPriceSum()]);
            Obat::where('id', $obat->id)->decrement('stok', $obat->quantity);
        }

        return redirect()->route('after');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTransaksiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransaksiRequest $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $userid = auth()->user()->id;
        $cartItems = \Cart::session($userid)->getContent();
        return view('user.detailpembelian', [
            'cart' => $cartItems,
            'transaksi' => $transaksi
        ]);
    }

    public function showadmin(Transaksi $transaksi)
    {
        return view('admin.detailriwayattransaksi', [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi
        ]);
    }

    public function updateStatTransaksi(Request $request)
    {
        $transaksi = Transaksi::find($request['id']);
        $transaksi->update(['status' => $request['status']]);
        return redirect()->back();

    }

    public function after()
    {
        $userid = auth()->user()->id;
        $cartItems = \Cart::session($userid)->getContent();
        return view('user.afterpembelian',[
            'cart' => $cartItems
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTransaksiRequest  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
