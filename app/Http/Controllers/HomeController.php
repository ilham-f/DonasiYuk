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
        $program = Program::join('program_images', 'programs.id', '=', 'program_images.program_id')->select('programs.*', 'program_images.*')->where('programs.batastanggal','>=',$now)->where('programs.status','=','1')->where('program_images.mainImage','=','1')->orderBy('programs.batastanggal', 'asc')->get();
        $newest = Program::join('program_images', 'programs.id', '=', 'program_images.program_id')->select('programs.*', 'program_images.*')->where('programs.batastanggal','>=',$now)->where('programs.status','=','1')->where('program_images.mainImage','=','1')->orderBy('programs.id', 'desc')->get();
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
