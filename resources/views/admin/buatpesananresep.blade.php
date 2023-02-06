@extends('admin.layouts.main')

@section('content')

<form action="{{ route('buatpesanan') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="pilihresep" class="form-label">Pilih Resep</label>
        <select class="form-select" aria-label="Default select example" id="pilihresep" name="resep_id">
            <option selected>Pilih Resep</option>
            @foreach ($resep as $res)
            <option value="{{ $res->id }}">{{ $res->id }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="obatobat" class="form-label">Obat Obat</label>
        <input type="text" class="form-control" id="obatobat" aria-describedby="emailHelp" name="obat_obat">
        <div id="emailHelp" class="form-text">Format : NamaObat(jumlahObat), Pisahkan dengan Koma</div>
    </div>
    <div class="mb-3">
        <label for="totalharga" class="form-label">Total Harga</label>
        <input type="number" class="form-control" id="totalharga" aria-describedby="emailHelp" name="total_harga">
    </div>
    <button class="btn btn-success">Submit</button>
</form>

@endsection
