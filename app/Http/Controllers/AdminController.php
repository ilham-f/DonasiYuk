<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class AdminController extends Controller
{
    public function index(){
        return view('admin.admin',[
            'title' => 'Dashboard'
        ]);
    }

    public function tabelprogram(){

        return view('admin.tbl-program', [
            'programs' => Program::all(),
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

