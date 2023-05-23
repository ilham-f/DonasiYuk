@extends('admin.layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="page-heading text-center">
        <h3>Data Statistik DonasiYuk!</h3>
    </div>
    <!-- Content Row -->
    <div class="row">
        <!-- 5 Orang dengan jumlah donasi tertinggi -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col" style="margin-bottom: -40px">
                            <div class="fw-bold text-primary text-uppercase mb-1">
                                {{ count($top5Nominal) }} Orang dengan jumlah donasi tertinggi
                            </div>
                            <div class="text-gray-800">
                                <ol>
                                    @foreach ($top5Nominal as $topNom)
                                        <li class="p-1"><strong class="text-uppercase">{{ $topNom->nama }}</strong> dengan
                                            total donasi
                                            <strong>Rp{{ number_format($topNom->nominal, 0, ',', '.') }}</strong></li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5 Orang yang paling sering berdonasi -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col" style="margin-bottom: -40px">
                            <div class="fw-bold text-primary text-uppercase mb-1">
                                {{ count($top5Often) }} Orang yang paling sering berdonasi</div>
                            <div class="text-gray-800">
                                <ol>
                                    @foreach ($top5Often as $topOften)
                                        <li class="p-1"><strong class="text-uppercase">{{ $topOften->nama }}</strong>
                                            telah berdonasi sebanyak
                                            <strong>{{ number_format($topOften->howOften, 0, ',', '.') }} kali</strong></li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jumlah Program & Jumlah User -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col" style="margin-bottom: -40px">
                            <div class="fw-bold text-primary text-uppercase mb-1">
                                Jumlah user yang telah terdaftar
                            </div>
                            <div class="text-gray-800 mb-3">
                                <div class="d-flex">
                                    <span class="fw-bold me-2">{{ $jmlUser }}</span>
                                    <span class="fw-bold">User</span>
                                </div>
                            </div>
                            <div class="fw-bold text-primary text-uppercase">
                                Jumlah Program Galang Dana Berjalan</div>
                            <div class="text-gray-800">
                                <span class="fw-bold">Total Program : {{ $jmlProg }} Program</span>
                                <ul>
                                    <li class="p-1 text-success">{{ $jmlSehat }} Program Kesehatan</li>
                                    <li class="p-1 text-warning">{{ $jmlPendidikan }} Program Pendidikan</li>
                                    <li class="p-1 text-info">{{ $jmlBencana }} Program Bencana Alam</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Dana -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col text-center">
                            <div class="fw-bold text-primary text-uppercase mb-1">
                                jumlah Total dana terkumpul
                            </div>
                            <div class="text-gray-800 mb-3 mt-5 text-center">
                                {{-- @dd($totalDana->nominal) --}}
                                <div class="d-flex justify-content-center" style="font-size: 40px">
                                    <span class="fw-bold">Rp</span>
                                    <span id="number-display"
                                        class="fw-bold">{{ number_format($totalDana, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Function to perform the number animation
            function animateNumber(totalDana, duration) {
                var startNumber = parseInt($('#number-display').text());

                // Calculate the number of steps
                var steps = Math.ceil(duration / 50); // Assuming each step takes 1 second

                // Calculate the increment for each step
                var increment = Math.ceil((totalDana - startNumber) / steps);

                // Define the interval for each step
                var interval = duration / steps;

                // Start the animation
                var currentNumber = startNumber;
                var counter = setInterval(function() {
                    currentNumber += increment;

                    // Check if the animation has reached or exceeded the target number
                    if (currentNumber >= totalDana) {
                        clearInterval(counter);
                        currentNumber = totalDana;
                    }

                    // Update the displayed number
                    $('#number-display').text(currentNumber);
                }, interval);
            }

            // Function to fetch the updated data from the API
            function fetchData() {
                $.ajax({
                    url: '/getTotalDana',
                    method: 'GET',
                    success: function(response) {
                        var totalDana = parseInt(response); // Extract the updated number from the API response
                        console.log(totalDana);
                        animateNumber(totalDana, 3000); // Animate to the updated number in 3 seconds
                    },
                    error: function() {
                        console.log('Failed to fetch data from the API.');
                    }
                });
            }

            // Call the fetchData function every 5 seconds to get the updated data
            setInterval(fetchData, 5000);
        });
    </script>
@endsection
