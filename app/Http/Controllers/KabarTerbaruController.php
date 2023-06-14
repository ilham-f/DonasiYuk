<?php

namespace App\Http\Controllers;

use App\Models\KabarTerbaru;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKabarTerbaruRequest;
use App\Http\Requests\UpdateKabarTerbaruRequest;

class KabarTerbaruController extends Controller
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


    public function create(Request $request)
    {
        $validated = $request->validate([
            'judulKabar' => ['required'],
            'detailKabar' => ['required'],
            'program_id' => ['required'],
            'image' => ['required', 'image', 'file']
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('programs');
        }

        $created = KabarTerbaru::create($validated);
        if ($created) {
            return back()->with('alert', 'Kabar Terbaru anda berhasil dibuat!');
        } else {
            return back()->with('alert', 'Error, Kabar Terbaru gagal dibuat');
        }
    }

    public function delete(Request $request)
    {
        $validated = $request->validate([
            'id' => ['required']
        ]);

        $kabar = KabarTerbaru::find($request->id);
        $deleted = $kabar->delete();
        if ($deleted) {
            return back()->with('alert', 'Kabar Terbaru anda berhasil dihapus!');
        } else {
            return back()->with('alert', 'Error, Kabar Terbaru gagal dihapus');
        }
    }

    public function update(Request $request, $id)
    {
        // dd($id);
        $validated = $request->validate([
            'judulKabar' => ['required'],
            'detailKabar' => ['required'],
            'image' => ['image', 'file']
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('programs');
        }

        $kabar = KabarTerbaru::find($id);
        $updated = $kabar->update($validated);
        if ($updated) {
            return back()->with('isUpdated', 'Kabar Terbaru anda berhasil diubah!');
        } else {
            return back()->with('isUpdated', 'Error, Gagal mengubah Kabar Terbaru');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKabarTerbaruRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKabarTerbaruRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KabarTerbaru  $kabarTerbaru
     * @return \Illuminate\Http\Response
     */
    public function show(KabarTerbaru $kabarTerbaru)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KabarTerbaru  $kabarTerbaru
     * @return \Illuminate\Http\Response
     */
    public function edit(KabarTerbaru $kabarTerbaru)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KabarTerbaru  $kabarTerbaru
     * @return \Illuminate\Http\Response
     */
    public function destroy(KabarTerbaru $kabarTerbaru)
    {
        //
    }
}
