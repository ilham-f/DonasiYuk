<?php

namespace App\Http\Controllers;

use App\Models\ProgramImage;
use App\Http\Requests\StoreProgramImageRequest;
use App\Http\Requests\UpdateProgramImageRequest;

class ProgramImageController extends Controller
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
     * @param  \App\Http\Requests\StoreProgramImageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramImageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProgramImage  $programImage
     * @return \Illuminate\Http\Response
     */
    public function show(ProgramImage $programImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProgramImage  $programImage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProgramImage $programImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramImageRequest  $request
     * @param  \App\Models\ProgramImage  $programImage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramImageRequest $request, ProgramImage $programImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProgramImage  $programImage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProgramImage $programImage)
    {
        //
    }
}
