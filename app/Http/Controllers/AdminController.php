<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Program;
use App\Models\PencairanDana;
use App\Models\Donasi;

class AdminController extends Controller
{
    public function index(){
        // 5 Orang paling sering donasi
        $top5Often = Donasi::join('users', 'users.id','=','donasis.user_id')->select('user_id','nama')
                ->selectRaw('COUNT(*) AS howOften')
                ->groupBy('user_id')
                ->orderByRaw('howOften DESC')
                ->paginate(5);

        // 5 Orang nominal donasi tertinggi
        $top5Nominal = Donasi::join('users', 'users.id','=','donasis.user_id')->select('user_id','nama')
            ->selectRaw('SUM(donasis.jml_donasi) AS nominal')
            ->groupBy('user_id')
            ->orderByRaw('nominal DESC')
            ->paginate(5);

        // Total dana terkumpul
        $danaCair = PencairanDana::selectRaw('SUM(jumlah) AS danaCair')->first();
        $danaDonasi = Donasi::selectRaw('SUM(jml_donasi) AS danaDonasi')->first();
        $totalDana = $danaDonasi->danaDonasi - $danaCair->danaCair;

        // Jumlah Program berjalan
        $jmlProg = count(Program::where('status','=','1')->get());
        // Jumlah Kesehatan
        $jmlSehat = count(Program::where('status','=','1')->where('category_id','=','1')->get());
        // Jumlah Pendidikan
        $jmlPendidikan = count(Program::where('status','=','1')->where('category_id','=','2')->get());
        // Jumlah Bencana Alam
        $jmlBencana = count(Program::where('status','=','1')->where('category_id','=','3')->get());

        // Jumlah User
        $jmlUser = count(User::where('role','=','pengunjung')->get());

        return view('admin.admin',[
            'title' => 'Dashboard',
            'top5Often' => $top5Often,
            'top5Nominal' => $top5Nominal,
            'jmlProg' => $jmlProg,
            'jmlSehat' => $jmlSehat,
            'jmlPendidikan' => $jmlPendidikan,
            'jmlBencana' => $jmlBencana,
            'jmlUser' => $jmlUser,
            'totalDana' => $totalDana
        ]);

    }

    public function getTotalDana(){
        $danaCair = PencairanDana::selectRaw('SUM(jumlah) AS danaCair')->first();
        $danaDonasi = Donasi::selectRaw('SUM(jml_donasi) AS danaDonasi')->first();

        $totalDana = $danaDonasi->danaDonasi - $danaCair->danaCair;

        return $totalDana;
    }

    public function tabelprogram(){

        return view('admin.tbl-program', [
            'programs' => Program::all(),
            'title' => 'Data Program'
        ]);
    }

    public function tabeluser(){

        return view('admin.tbl-user', [
            'users' => User::where('role','=','pengunjung')->orderBy('id','desc')->get(),
            'title' => 'Data User'
        ]);
    }

    public function tabeltransaksi(){

        return view('admin.tbl-transaksi', [
            'transaksis' => Donasi::join('users', 'users.id','=','donasis.user_id')->join('programs','programs.id','=','donasis.program_id')->select('users.nama','programs.judul','donasis.jml_donasi','donasis.created_at')->orderBy('donasis.id','desc')->paginate(10),
            'title' => 'Data Transaksi'
        ]);
    }

    public function ubahprogram(Request $request){
        $validated = $request->validate([
            'status' => ['required'],
        ]);
        // dd($validated);
        $program = Program::find($request->program_id);
        $program->update($validated);

        return redirect('/tblprogram')->with('status', 'Status program berhasil diubah');
    }

}

