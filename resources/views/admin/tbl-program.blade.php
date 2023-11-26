@extends('admin.layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-md-1 order-last mb-2 text-center">
                    <h3>Data Program</h3>
                </div>
            </div>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Judul</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($programs as $program)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <img style="display: block; height: 81px; width: 150px"
                                            src="{{ asset('storage/'.$program->image) }}" alt="{{ $program->image }}" />
                                    </td>
                                    <td>{{ $program->judul }}</td>
                                    <td class="text-center">
                                        @if ($program->status == 1)
                                            <div class="py-2 rounded text-center" style="background-color: #d1e7dd">
                                                <small class="text-success fst-italic">Sedang Berjalan</small>
                                            </div>
                                        @elseif ($program->status == 0)
                                            <div class="py-2 rounded text-center" style="background-color: #fff3cd">
                                                <small class="text-warning fst-italic">Proses Verifikasi</small>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{-- <button style="height: 50%;" class="btn btn-info text-light" data-bs-toggle="modal"
                                            data-bs-target="#info-{{ $program->id }}">Info</button> --}}
                                        <button style="height: 50%;" class="btn btn-warning text-light"
                                            data-bs-toggle="modal" data-bs-target="#ubah-{{ $program->id }}">Ubah</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Ubah-->
    @foreach ($programs as $program)
        <div class="modal fade" id="ubah-{{ $program->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Ubah program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row d-flex flex-column" action="/ubahprogram" method="POST">
                            @csrf
                            <div class="col mb-3">
                                <label for="program" class="form-label">Judul program</label>
                                <input type="text" name="judul" class="form-control" value="{{ $program->judul }}"
                                    readonly />
                            </div>
                            <div class="col mb-3">
                                <label>Status</label>
                                <select class="form-select w-50 border-1 rounded" name="status">
                                    {{-- <option>Pilih Status</option> --}}
                                    {{-- @dd($program->created_at) --}}
                                    @if ($program->status == 1 && Carbon\Carbon::parse($program->created_at) < time())
                                        <option selected value="1">Sedang Berjalan</option>
                                        <option value="0">Proses Verifikasi</option>
                                    @elseif ($program->status == 0 && Carbon\Carbon::parse($program->created_at) < time())
                                        <option selected value="0">Proses Verifikasi</option>
                                        <option value="1">Sedang Berjalan</option>
                                    @else
                                        <div class="py-2 rounded" style="background-color: #fff3cd">
                                            <small class="text-danger fst-italic">Telah berakhir</small>
                                        </div>
                                    @endif
                                </select>
                            </div>
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
                            {{-- <div class="col mb-3">
                                <label for="program" class="form-label">Status</label>
                                <input type="text" name="status" class="form-control" value="{{ $program->status }}" />
                            </div> --}}
                            <button type="submit" class="btn btn-info ms-3 text-light" style="width: 150px">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
