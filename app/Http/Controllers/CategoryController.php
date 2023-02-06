<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()) {
            $userid = Auth::user()->id;
            $cartItems = \Cart::session($userid)->getContent();
            return view('user.categories',[
                'cart' => $cartItems,
                'categories' => Category::all()
            ]);
        }
        else{
            return view('user.categories', [
                'categories' => Category::all()
            ]);
        }
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
        if (Auth::user()) {
            $userid = Auth::user()->id;
            $cartItems = \Cart::session($userid)->getContent();
            return view('user.produk',[
                'cart' => $cartItems,
                'title' => "Obat Kategori : $category->nama",
                'obats' => $category->obats()->paginate(8)
            ]);
        }
        else{
            return view('user.produk', [
                'title' => "Obat Kategori : $category->nama",
                'obats' => $category->obats()->paginate(8)
            ]);
        }
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
        $category->slug = $request->input('slug');
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
}
