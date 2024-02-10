@section('title', 'Dashboard User')
@section('pages1', 'User')
@section('pages2', 'Dashboard')
@extends('/layoutsuser/master')
@section('content')
<div class="container-fluid py-0">
    <h4 class=" mb-0 text-white">Selamat datang, {{ Auth::user()->name }}! </h4>
</div>
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">SKBHK REGULER</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $suratoffice }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">SKBHK FRANCHISE</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $suratfranchise }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">SKBHK EIR 003</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $surat003 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">SKBHK EIR 005</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $surat005 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">SKBHK 004</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $surat004 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card  mb-4">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">SKBHK EIR 006</p>
                                        <h5 class="font-weight-bolder">
                                            {{ $surat006 }}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="card z-index-2">
                    <div class="card-header col-12 p-3 pb-0 d-flex align-items-center">
                        <form action="{{ url('/admin/dashboard') }}" method="get" class="col-2">
                            <div class="form-group col-12" style="position: relative;">
                                <label for="year" style="margin-right: 10px;">Select Year:</label>
                                <select name="year" id="year" class="form-control"
                                    onchange="this.form.submit()">
                                    <option value="" disabled selected>Pilih salah satu</option>
                                    @foreach (range(date('Y'), 2022, +1) as $year)
                                        <option value="{{ $year }}"
                                            {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                                <div style="position: absolute; top: 72%; right: 10px; transform: translateY(-50%);">
                                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-header p-0 pb-0 text-center">
                        <h4 class="text-capitalize">Grafik SKBHK</h4>
                        <h4 class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>{{ $selectedYear }}
                        </h4>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="mixed-chart" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid py-1">
    <div class="row">
        <div class="col-lg-12 mb-4 mb-lg-0">
            <div class="card z-index-2 h-100">
                <div class="container">
                    <div class="row my-2">
                        <div class="col-md-9 mx-auto text-center">
                            <h3>Frequently Asked Questions</h3>
                            <p>SKBHK Reguler merupakan SKBHK yang digunakan di lingkup PT SAT <br> sedangkan SKBHK
                                Franchise merupakan SKBHK yang digunakan di lingkup Franchise </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div class="accordion" id="accordionRental">
                                <div class="accordion-item mb-3">
                                    <h6 class="accordion-header" id="headingOne">
                                        <button class="accordion-button border-bottom font-weight-bold collapsed"
                                            type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            SKBHK EIR 003?
                                            <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                            <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                        </button>
                                    </h6>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionRental"
                                        style="">
                                        <div class="accordion-body text-sm opacity-8">
                                            <p style="color: black; font-size:14px">
                                                SKBHK EIR 003 merupakan salah satu surat SKBHK reguler dengan beberapa
                                                alasan berakhir sebagai berikut:
                                                <br>
                                                1. Meninggal dunia <br>
                                                2. Ditahan pihak yang berwajib <br>
                                                3. Melanggar peraturan perusahaan <br>
                                                4. Melakukan Pelanggaran bersifat mendesak <br>
                                                5. Adanya putusan lembaga penyelesaian perselisihan hubungan industrial
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3">
                                    <h6 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button border-bottom font-weight-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            SKBHK EIR 004?
                                            <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                            <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                        </button>
                                    </h6>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionRental">
                                        <div class="accordion-body text-sm opacity-8">
                                            <p style="color: black; font-size:14px">
                                                SKBHK EIR 004 merupakan salah satu surat SKBHK franchise dengan beberapa
                                                alasan berakhir sebagai berikut:
                                                <br>
                                                1. Meninggal dunia <br>
                                                2. Ditahan pihak yang berwajib <br>
                                                3. Melanggar peraturan perusahaan <br>
                                                4. Melakukan Pelanggaran bersifat mendesak <br>
                                                5. Adanya putusan lembaga penyelesaian perselisihan hubungan industrial
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3">
                                    <h6 class="accordion-header" id="headingThree">
                                        <button class="accordion-button border-bottom font-weight-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            SKBHK EIR 005?
                                            <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                            <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                        </button>
                                    </h6>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionRental">
                                        <div class="accordion-body text-sm opacity-8">
                                            <p style="color: black; font-size:14px">
                                                SKBHK EIR 005 merupakan salah satu surat SKBHK reguler dengan beberapa
                                                alasan berakhir sebagai berikut:
                                                <br>
                                                1. Jangka waktu perjanjian kerja waktu tertentu telah berakhir <br>
                                                2. Masa probation telah berakhir <br>
                                                3. Memasuki Usia Pensiun <br>
                                                4. Mangkir 5 hari kerja atau lebih berturut-turut <br>
                                                5. Mengundurkan Diri <br>
                                                6. Perusahaan melakukan Merger/ Akuisisi <br>
                                                7. Perusahaan melakukan Efisiensi <br>
                                                8. Keadaan memaksa (Force majeure) <br>
                                                9. Perusahaan mengalami Pailit <br>
                                                10. Perusahaan mengalami kerugian
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item mb-3">
                                    <h6 class="accordion-header" id="headingFour">
                                        <button class="accordion-button border-bottom font-weight-bold" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            SKBHK EIR 006?
                                            <i class="collapse-close fa fa-plus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                            <i class="collapse-open fa fa-minus text-xs pt-1 position-absolute end-0 me-3"
                                                aria-hidden="true"></i>
                                        </button>
                                    </h6>
                                    <div id="collapseFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionRental">
                                        <div class="accordion-body text-sm opacity-8">
                                            <p style="color: black; font-size:14px">
                                                SKBHK EIR 006 merupakan salah satu surat SKBHK franchise dengan beberapa
                                                alasan berakhir sebagai berikut:
                                                <br>
                                                1. Jangka waktu perjanjian kerja waktu tertentu telah berakhir <br>
                                                2. Masa probation telah berakhir <br>
                                                3. Memasuki Usia Pensiun <br>
                                                4. Mangkir 5 hari kerja atau lebih berturut-turut <br>
                                                5. Mengundurkan Diri <br>
                                                6. Perusahaan melakukan Merger/ Akuisisi <br>
                                                7. Perusahaan melakukan Efisiensi <br>
                                                8. Keadaan memaksa (Force majeure) <br>
                                                9. Perusahaan mengalami Pailit <br>
                                                10. Perusahaan mengalami kerugian
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        new Chart(ctx1, {
            type: "line",
            data: {
                labels: {!! json_encode(
                    $suratData->pluck('month')->map(function ($month) {
                        return \Carbon\Carbon::create()->month($month)->format('M');
                    }),
                ) !!},
                datasets: [{
                    label: "Surat Success",
                    tension: 0.6,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#f5365c",
                    backgroundColor: gradientStroke1,
                    borderWidth: 1,
                    fill: true,
                    data: {!! json_encode($suratData->pluck('total')) !!},
                    maxBarThickness: 2
                }],
            },

        });
    </script>
    <script>
        var ctx1 = document.getElementById("mixed-chart").getContext("2d");

        new Chart(ctx1, {
            data: {
                labels: {!! json_encode(
                    $suratData->pluck('month')->map(function ($month) {
                        return \Carbon\Carbon::create()->month($month)->format('M');
                    }),
                ) !!},
                datasets: [{
                    type: "line",
                    label: "SKBHK SUCCESS",
                    tension: 0.3,
                    borderWidth: 0,
                    pointRadius: 0,
                    pointBackgroundColor: "#f5365c",
                    borderColor: "#f5365c",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    data: {!! json_encode($suratData->pluck('total')) !!},
                    fill: true,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 13,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: true,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 10,
                            font: {
                                size: 13,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        // Function to update the chart based on the selected year
        function updateChart(selectedYear) {

            fetch('/getchartdata?year=' + selectedYear)
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function(data) {
                    // Update the chart data
                    mixedChart.data.datasets[0].data = data;

                    // Update the chart labels
                    mixedChart.data.labels = data.labels; // Assuming the server provides labels

                    // Update the chart
                    mixedChart.update();
                })
                .catch(function(error) {
                    console.error('Error fetching data:', error);
                });
        }

        // Event listener for the year selection dropdown
        document.getElementById('year').addEventListener('change', function() {
            // Get the selected year
            var selectedYear = this.value;

            // Call the updateChart function with the selected year
            updateChart(selectedYear);
        });

        // Initial chart update with the current year
        updateChart({{ $selectedYear }});
    </script>

@endsection
