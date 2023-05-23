@extends('admin.layouts.main')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 order-md-1 order-last mb-2 text-center">
                    <h3>Data User</h3>
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
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-capitalize">{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="d-flex justify-content-center align-items-center">
                                        <button style="height: 50%;" class="btn btn-info text-light" data-bs-toggle="modal"
                                            data-bs-target="#info-{{ $user->id }}">Info</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal Info-->
    @foreach ($users as $user)
        <div class="modal fade" id="info-{{ $user->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Detail User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex flex-column">
                            <div class="col mb-3">
                                <label for="user" class="form-label">No. Telepon</label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ $user->notelp ?? 'User belum melengkapi No. Telepon' }}" readonly />
                            </div>
                            <div class="col mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea style="height: 100px" class="form-control" name="alamat" readonly>{{ $user->alamat ?? 'User belum melengkapi Alamat' }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
