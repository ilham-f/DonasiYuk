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

    public function tabelprogram(){
        return view('admin.obat', [
            'programs' => Program::all(),
            'categories' => Category::all(),
            'title' => 'Program'
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
            'title' => 'Kategori'
        ]);
    }

}

