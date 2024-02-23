@section('title', 'Scan QR Code')
@section('pages1', 'QR Code')
@section('pages2', 'Scan')
@extends('/layouts/master')
@section('content')
    <div class="multisteps-form">
        <div class="row">
            <!-- Panel untuk Pencarian Karyawan -->
            <div class="col-10 col-lg-8 mx-auto mt-0 mb-sm-1 mb-3">
                <div class="multisteps-form__progress">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-plain card-blog mt-3">
                    <!-- Form Pencarian Karyawan -->
                    <div class="card p-6  border-radius-xl bg-white js-active" data-animation="FadeIn">
                        <div style="width: 500px" id="reader" class="mx-auto"></div>
                        <div class="col-12 pe-auto" id="scan-kembali" style="cursor: pointer">
                            <div class="p-3 text-center bg-white border-radius-lg shadow-lg">
                                <div class="icon icon-shape icon-md bg-gradient-warning shadow text-center">
                                    <i class="fas fa-camera" style="color: white"></i>
                                </div>
                                <h5 class="mt-3">Scan Kembali</h5>
                            </div>
                        </div>
                        <table class="table table-bordered mt-5" id="table-scan">
                            <tbody>
                                <tr>
                                    <th scope="col">Id Surat</th>
                                    <th id="id_surat"></th>
                                </tr>
                                <tr>
                                    <th scope="col">Nama Pembuat Surat</th>
                                    <th id="nama_pembuat_surat"></th>
                                </tr>
                                <tr>
                                    <th scope="col">Nama Karyawan</th>
                                    <th id="nama_karyawan"></th>
                                </tr>
                                <tr>
                                    <th scope="col">Jenis Surat</th>
                                    <th id="jenis_surat"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"
        integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Kemudian sertakan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#table-scan').hide();
            $('#scan-kembali').hide();
        })

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: 250
            });

        function onScanSuccess(decodedText, decodedResult) {
            $.ajax({
                url: '/admin/scanqrcode',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    qrdata: decodedText
                },
                success: function(response) {
                    $('#id_surat').html(response.data?.id);
                    $('#nama_pembuat_surat').html(response.data?.user?.name);
                    $('#nama_karyawan').html(response.data?.karyawan?.nama);
                    $('#jenis_surat').html(response.jenis_surat);
                    $('#table-scan').show();
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Silahkan periksa kembali qr code anda',
                    });
                }
            });
            html5QrcodeScanner.clear();
            $('#scan-kembali').show();
        }

        html5QrcodeScanner.render(onScanSuccess);

        $('#scan-kembali').click(function() {
            $('#reader').show();
            $('#table-scan').hide();
            $('#scan-kembali').hide();
            html5QrcodeScanner.render(onScanSuccess);
        })
    </script>

@endsection
