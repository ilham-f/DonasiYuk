@extends('partials.profil')

@section('body')
    <h4>Donasi Saya</h4>
    <hr class="mt-0 mb-3">
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
                @php
                    $currentPage = $mydonasi->currentPage();
                    $perPage = $mydonasi->perPage();
                    $startNumber = ($currentPage - 1) * $perPage + 1;
                @endphp
                @foreach ($mydonasi as $program)
                    <tr>
                        {{-- No. --}}
                        <td class="text-center">{{ $startNumber + $loop->index }}</td>
                        {{-- Gambar --}}
                        <td class="d-flex justify-content-center align-items-center">
                            <img style="display: block; height: 81px; width: 150px"
                                src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->image }}" />
                        </td>
                        {{-- Judul --}}
                        <td style="max-width: 200px;text-overflow: ellipsis; white-space: nowrap; overflow: hidden;">
                            {{ $program->judul }}</td>
                        {{-- jml_donasi --}}
                        <td class="text-center">
                            <span>{{ $program->jml_donasi }}</span>
                        </td>
                        <td>
                            <button class="btn btn-dark" onclick="window.location.href='/programs/{{ $program->program_id }}'">Lihat Program</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $mydonasi->links() }}
        </div>
    @else
        <span>Anda belum pernah berdonasi</span>
    @endif
@endsection
