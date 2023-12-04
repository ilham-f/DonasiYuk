<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Program;
use App\Models\User;
use App\Models\ProgramImage;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProgramRequest;
use App\Http\Requests\UpdateProgramRequest;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $now = Carbon::now();
        $program = Program::where('batastanggal','>=',$now)->where('status','=','1');
        return view('user.program', [
            'programs' => $program->paginate(12),
            'title' => "Semua Program",
        ]);
    }

    function editFotoProgram(Request $request, $programid) {
        $validated = $request->validate([
            'image' => ['required', 'image', 'file']
        ]);
        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('programs');
        }
        $program = Program::find($programid);
        $created = $program->update([
            'image' => $validated['image']
        ]);
        if ($created) {
            return back()->with('alert', 'Foto Program berhasil diubah!');
        } else {
            return back()->with('alert', 'Error, gagal mengubah foto program');
        }
    }

    public function hasilCari()
    {
        $now = Carbon::now();
        $program = Program::where('batastanggal','>=',$now)->where('status','=','1');
        return view('user.hasilpencarian', [
            'programs' => $program->filter(request(['search']))->paginate(12)->withQueryString(),
        ]);
    }

    // Filter Program Mendesak
    public function getDesakSemua()
    {
        $now = Carbon::now();
        $program = Program::where('batastanggal','>=',$now)->where('status','=','1')->orderBy('batastanggal', 'asc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
            if ($p->category_id == 1) {
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
            }
            else if ($p->category_id == 2) {
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
            }
            else if ($p->category_id == 3) {
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
            }
        }

        return $programArr;
    }

    public function getDesakSehat()
    {
        $now = Carbon::now();
        $program = Program::where('category_id','=',1)->where('batastanggal','>=',$now)->where('status','=','1')->orderBy('batastanggal', 'asc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
        }

        return $programArr;
    }
    public function getDesakPendidikan()
    {
        $now = Carbon::now();
        $program = Program::where('category_id','=',2)->where('batastanggal','>=',$now)->where('status','=','1')->orderBy('batastanggal', 'asc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
        }

        return $programArr;
    }
    public function getDesakBencana()
    {
        $now = Carbon::now();
        $program = Program::where('category_id','=',3)->where('batastanggal','>=',$now)->where('status','=','1')->orderBy('batastanggal', 'asc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide desak'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
        }

        return $programArr;
    }

    // Filter Program Terbaru
    public function getBaruSemua()
    {
        $now = Carbon::now();
        $program = Program::where('batastanggal','>=',$now)->where('status','=','1')->orderBy('id', 'desc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
            if ($p->category_id == 1) {
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
            }
            else if ($p->category_id == 2) {
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
            }
            else if ($p->category_id == 3) {
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
            }
        }

        return $programArr;
    }

    public function getBaruSehat()
    {
        $now = Carbon::now();
        $program = Program::where('category_id','=',1)->where('batastanggal','>=',$now)->where('status','=','1')->orderBy('id', 'desc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-success mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-success" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
        }

        return $programArr;
    }
    public function getBaruPendidikan()
    {
        $now = Carbon::now();
        $program = Program::where('category_id','=',2)->where('batastanggal','>=',$now)->where('status','=','1')->orderBy('id', 'desc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-warning mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-warning" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
        }

        return $programArr;
    }
    public function getBaruBencana()
    {
        $now = Carbon::now();
        $program = Program::where('category_id','=',3)->where('batastanggal','>=',$now)->where('status','=','1')->orderBy('id', 'desc')->get();

        $programArr = array();

        foreach ($program as $key => $p) {
            $dana = $p->danaterkumpul;
            $target = $p->target;
            $persen = ($dana / $target) * 100;

            $diff = strtotime($p->batastanggal) - time();

            $day = $diff / 86400;
            // days
            $days = floor($day);
            // hours
            $hours = floor($day * 24);
            // minutes
            $minutes = floor($day * 1440);
            // seconds
            $seconds = floor($diff);

            // dd($minutes);
                if ($days <= 0 && $hours <= 0 && $minutes != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$minutes.' menit lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days <= 0 && $hours != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$hours.' jam lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
                else if ($days != 0) {
                    $result = '<div class="swiper-slide baru'. $p->category_id.' p col-lg mb-2 mt-4">
                        <div class="card h-100" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);">
                            <!-- Gambar Program -->
                            <img class="card-img-top" style="display: block; height: 150px; width: 265px; object-fit: fill;"
                                src="storage/'.$p->image.'"
                                alt="'. $p->image.'" />
                            <!-- Detail Program -->
                            <div class="card-body p-4 pt-3 pb-0">
                                <div class="judul"
                                    style="width: 100%;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                                    <!-- Nama Program -->
                                    <small class="fw-bolder">'. $p->judul.'</small>
                                </div>
                            </div>
                            <!-- Program Footer-->
                            <div class="p-4 pt-2">
                                <small>
                                    '.$days.' hari lagi
                                </small>
                                <p class="mb-0 fw-bolder">Rp'. $p->danaterkumpul.'</p>
                                <small>Terkumpul dari Rp'. $p->target.'</small>

                                <div class="border border-info mt-2 rounded-pill"
                                    style="overflow: hidden">
                                    <div id="'. $p->id.'"
                                        class="rounded-pill bg-info" style="height:10px; width:'.$persen.'%;">
                                    </div>
                                </div>

                                <div class="text-center">
                                    <a class="d-flex justify-content-center btn btn-outline-dark mt-3 w-100"
                                        style="height: 35px" href="programs/'. $p->id.'">
                                        <small>Detail</small>
                                    </a>
                                </div>

                                <a href="/form-donasi/'. $p->id.'" style="height: 35px" type="submit"
                                    class="d-flex justify-content-center btn btn-outline-dark mt-2 w-100">
                                    <small>Donasi Sekarang</small>
                                </a>
                            </div>
                        </div>
                    </div>';
                    $programArr[] = $result;
                }
        }

        return $programArr;
    }

    // Progress Bar
    public function getprogram()
    {
        $program = Program::all();
        return $program;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function getProgramDetail(Program $program)
    {
        // dd($program);
        return $program;
    }

    public function urutMendesak(){
        $now = Carbon::now();
        $program = Program::where('batastanggal','>=',$now)->where('status','=','1')->orderBy('batastanggal', 'asc')->paginate(12);
        return view('user.program',[
            'categories' => Category::all(),
            'programs' => $program,
            'title' => "Semua Program",
        ]);
    }


    public function urutTerbaru(){
        $now = Carbon::now();
        $program = Program::where('batastanggal','>=',$now)->where('status','=','1')->orderBy('programs.id', 'desc')->paginate(12);
        return view('user.program',[
            'categories' => Category::all(),
            'programs' => $program,
            'title' => "Semua Program",
        ]);
    }

    public function galangdana()
    {
        return view('user.form-program');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required'],
            'category_id' => ['required'],
            'judul' => ['required'],
            'target' => ['required'],
            'batastanggal' => ['required'],
            'deskripsi' => ['required'],
            'image' => ['required', 'image', 'file']
        ]);

        if ($request->file('image')) {
            $validated['image'] = $request->file('image')->store('programs');
        }

        $created = Program::create($validated);
        if ($created) {
            return redirect('/programku')->with('alert', 'Program anda berhasil dibuat! Mohon menunggu verifikasi dari admin');
        } else {
            return back()->with('alert', 'Error, Program gagal dibuat');
        }

    }

    public function show(Program $program)
    {
        // dd($image);
        return view('user.detail-program', [
            'program' => $program,
            'owner' => User::find($program->user_id),
            'kabars' => KabarTerbaru::where('program_id','=',$program->id)->get(),
            'pencairans' => PencairanDana::where('program_id','=',$program->id)->get(),
            'donasis' => Donasi::join('users','users.id','=','donasis.user_id')->select('donasis.*', 'users.nama','users.anonim', 'donasis.program_id')->where('program_id','=',$program->id)->paginate(3)
        ]);
    }


    public function update(Request $request, $programid)
    {
        $userid = Auth::user()->id;
        $program = Program::find($programid);
        // dd($program);
        if (!$request->judul) {
            $data = $request->validate([
                'deskripsi' => ['required']
            ]);
        }
        else {
            $data = $request->validate([
                'judul' => ['required']
            ]);
        }
        // dd($data);
        $updated = $program->update($data);
        if ($updated) {
            return back()->with('isUpdated','Berhasil Update');
        }

        return back()->with('isUpdated','Gagal Update');
    }

}
