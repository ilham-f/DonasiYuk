<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\Category;
use App\Models\News;
use App\Models\ProgramImage;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(){
        $now = Carbon::now();
        $program = Program::where('batastanggal','>=',$now)->where('status','=','1')->orderBy('batastanggal', 'asc')->get();
        $newest = Program::where('batastanggal','>=',$now)->where('status','=','1')->orderBy('id', 'desc')->get();
        $news = News::all();
        // dd($program);
        return view('user.home-page',[
            'categories' => Category::all(),
            'programs' => $program,
            'newest' => $newest,
            'news' => $news
        ]);
    }
}
