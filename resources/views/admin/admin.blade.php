@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="page-heading">
        <h3>Statistik Penjualan</h3>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Weekly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Pemasukan (All Time)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp{{ $jumlahpemasukan }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
