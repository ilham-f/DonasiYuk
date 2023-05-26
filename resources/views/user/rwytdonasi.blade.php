@extends('partials.profil')

@section('body')
    <h4>Donasi Saya</h4>
    <hr class="mt-0 mb-3">
    <div class="container-fluid" style="overflow-y: auto; height: 450px">
        @if ($mydonasi->isNotEmpty())
            <table class="table table-hover">
                <thead class="sticky-top table-light">
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Gambar</th>
                        <th>Judul Program</th>
                        <th class="text-center">Jumlah Donasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mydonasi as $program)
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
                            {{-- jml_donasi --}}
                            <td class="text-center">{{ $donasi->jml_donasi }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <div class="d-flex justify-content-center">
                    {{ $programs->links() }}
                </div>
            </table>
        @else
            <span>Anda belum pernah berdonasi</span>
        @endif
    </div>
@endsection
