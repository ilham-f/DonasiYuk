@extends('partials.profil')

@section('body')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('alert'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('alert') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('gagal'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('gagal') }}
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
                                        <small class="text-warning fst-italic">Proses verifikasi</small>
                                    </div>
                                @else
                                    <div class="py-2 rounded" style="background-color: #fff3cd">
                                        <small class="text-danger fst-italic">Telah berakhir</small>
                                    </div>
                                @endif
                            </td>
                            {{-- Aksi --}}
                            <td class="text-center">
                                <button class="btn btn-info" onclick="window.location.href='programku/{{ $program->id }}'">
                                    <i class="bi bi-gear"></i>
                                    <span class="ms-2">Atur Program</span>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $myprogram->links() }}
            </div>
        @else
            <span>Anda belum memiliki program</span>
        @endif
    </div>
@endsection
