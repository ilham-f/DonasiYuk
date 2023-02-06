<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Obat;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(){
        if (Auth::user()) {
            $userid = Auth::user()->id;
            return view('user.home-page',[
                // 'obats' => Obat::all(),
                // 'categories' => Category::all()
            ]);
        }
        else{
            return view('user.home-page',[
                // 'obats' => Obat::all(),
                // 'categories' => Category::all()
            ]);
        }
    }
}
