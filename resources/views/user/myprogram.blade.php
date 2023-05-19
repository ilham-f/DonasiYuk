@extends('partials.profil')

@section('body')
    @if (session('status'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <h4>Program Saya</h4>
    <hr class="mt-0 mb-3">
    <div class="container-fluid" style="overflow-y: auto; height: 450px">
        @if ($myprogram->isNotEmpty())
            <table class="table table-hover">
                <thead class="sticky-top table-light">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Gambar</th>
                        <th>Judul</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($myprogram as $program)
                        <tr>
                            {{-- No. --}}
                            <td class="text-center">{{ $loop->iteration }}</td>
                            {{-- Gambar --}}
                            <td class="d-flex justify-content-center align-items-center">
                                <img style="display: block; height: 81px; width: 150px"
                                    src="{{ asset('storage/'.$program->image) }}" alt="{{ $program->image }}" />
                            </td>
                            {{-- Judul --}}
                            <td style="max-width: 200px;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">{{ $program->judul }}</td>
                            {{-- Status --}}
                            <td class="text-center">
                                @if ($program->status == 1)
                                    <div class="py-2 rounded" style="background-color: #d1e7dd">
                                        <small class="text-success fst-italic">Sedang berjalan</small>
                                    </div>
                                @elseif ($program->status == 0)
                                    <div class="py-2 rounded" style="background-color: #fff3cd">
                                        <small class="text-warning fst-italic">Proses Verifikasi</small>
                                    </div>
                                @endif
                            </td>
                            {{-- Aksi --}}
                            <td class="text-center">
                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info-{{ $program->id }}">
                                    <i class="bi bi-info-square"></i>
                                </button>
                                <button class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#ubah-{{ $program->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <span>Anda belum memiliki program</span>
        @endif
    </div>

    <!-- Modal Ubah-->
    @foreach ($myprogram as $program)
        <div class="modal fade" id="ubah-{{ $program->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Ubah Program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form class="row d-flex flex-column" action="/programku/{{ $program->id }}" method="post">
                            @method('put')
                            @csrf
                            <div class="col mb-3">
                                <label for="program" class="form-label">Judul</label>
                                <input type="text" name="judul" class="form-control"
                                    value="{{ $program->judul }}" />
                            </div>
                            <div class="col mb-3">
                                <label for="program" class="form-label">Deskripsi</label>
                                <textarea type="text" name="deskripsi" class="form-control"
                                    oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"' value="{{ $program->deskripsi }}">{{ $program->deskripsi }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-info ms-3 text-light"
                                style="width: 150px">Simpan</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

{{-- Sisa Hari --}}
{{-- <td class="text-center">
            @php
                $diff = strtotime($program->batastanggal) - time();

                $day = $diff / 86400;
                // days
                $days = floor($day);
                // hours
                $hours = floor($day * 24);
                // minutes
                $minutes = floor($day * 1440);
                // seconds
                $seconds = floor($diff);
            @endphp

            @if ($program->status == 1)
                <small>
                    @if ($days <= 0 && $hours <= 0 && $minutes != 0)
                        {{ $minutes }} menit lagi
                    @elseif ($days <= 0 && $hours != 0)
                        {{ $hours }} jam lagi
                    @elseif ($days != 0)
                        {{ $days }} hari lagi
                    @endif
                </small>
            @else
                <small>-</small>
            @endif
        </td> --}}
