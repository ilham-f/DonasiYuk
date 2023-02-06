<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Category;
use App\Models\Keluhan;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin',[
            'title' => 'Dashboard'
        ]);
    }

    public function tabelobat(){
        return view('admin.obat', [
            'obats' => Obat::all(),
            'categories' => Category::all(),
            'title' => 'Tabel Obat',
            'keluhan' => Keluhan::all()
        ]);
    }

    // public function tambahobat(){
    //     return view('admin.tambahobat', [
    //         'title' => 'Tambah Obat'
    //     ]);
    // }

    public function tabelkategori(){
        return view('admin.kategori',[
            'categories' => Category::all(),
            'title' => 'Tabel Kategori'
        ]);
    }

    // public function tambahkategori(){
    //     return view('admin.tambahkategori',[
    //         'title' => 'Tambah Kategori'
    //     ]);
    // }

    public function tabelkeluhan(){
        return view('admin.keluhan',[
            'keluhans' => Keluhan::all(),
            'title' => 'Tabel Keluhan'
        ]);
    }

    // public function tambahkeluhan(){
    //     return view('admin.tambahkeluhan',[
    //         'title' => 'Tambah Keluhan'
    //     ]);
    // }

}

