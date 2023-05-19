<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Category;
use App\Models\ProgramImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorecategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required'],
            'slug' => ['required']
        ]);

        Category::create($validated);
        return redirect('/tabelkategori')->with('alert', 'Kategori baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(category $category)
    {
        // dd($category->programs());
        $now = Carbon::now();
        $programs = $category->programs()->join('program_images', 'programs.id', '=', 'program_images.program_id')->select('programs.*', 'program_images.*')->where('batastanggal','>=',$now)->where('programs.status','=','1')->where('program_images.mainImage','=','1')->paginate(12);
        // dd($programs);
        return view('user.program', [
            'programs' => $programs,
            'title' => "$category->nama",
        ]);
    }

    public function showmendesak(category $category)
    {
        // dd($category->programs());
        $now = Carbon::now();
        $programs = $category->programs()->join('program_images', 'programs.id', '=', 'program_images.program_id')->select('programs.*', 'program_images.*')->where('batastanggal','>=',$now)->where('programs.status','=','1')->where('program_images.mainImage','=','1')->orderBy('batastanggal', 'asc')->paginate(12);
        // dd($programs);
        return view('user.program', [
            'programs' => $programs,
            'title' => "$category->nama",
        ]);
    }

    public function showterbaru(category $category)
    {
        // dd($category->programs());
        $now = Carbon::now();
        $programs = $category->programs()->join('program_images', 'programs.id', '=', 'program_images.program_id')->select('programs.*', 'program_images.*')->where('batastanggal','>=',$now)->where('programs.status','=','1')->where('program_images.mainImage','=','1')->orderBy('tglmulai', 'desc')->paginate(12);
        // dd($programs);
        return view('user.program', [
            'programs' => $programs,
            'title' => "$category->nama",
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->nama = $request->input('nama');
        $category->update();

        return redirect('/tabelkategori')->with('status', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect('/tabelkategori')->with('isDelete', 'Kategori berhasil dihapus');
    }

    // public function filter(Request $request)
    // {
    //     $programs = Program::where('category_id', $request->id)->get();
    //     // dd($program);
    //     foreach ($programs as $program) {
    //         $result =      '<div class="col-lg mb-2 mt-4">
    //                             <div class="card h-100 shadow-sm">

    //                                 <!-- Product image-->
    //                                 <img class="card-img-top" style="display: block; height: 150px"
    //                                 src="{{ asset('.$program->image.') }}" alt="{{'.$program->image.'}}" />

    //                                     <!-- Product details-->
    //                                     <div class="card-body p-4">
    //                                         <div class="text-center">
    //                                             <!-- Product name-->
    //                                             <h6 class="fw-bolder">{{'.$program->judul.'}}</h6>
    //                                             <!-- Product price-->
    //                                             <p style="margin-bottom: 0">Target : Rp. {{'.$program->target.'}}</p>
    //                                         </div>
    //                                     </div>
    //                                     <!-- Product actions-->
    //                             </div>
    //                         </div>';
    //     }

    //     return $result;
    // }
}
