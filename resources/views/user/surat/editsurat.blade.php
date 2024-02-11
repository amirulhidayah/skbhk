@section('title', 'Edit Surat')
@section('pages1', 'Surat SKBHK')
@section('pages2', 'Edit Surat')
@extends('/layoutsuser/master')
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
                    <form class="multisteps-form__form mb-1" action="{{ url('editsurat/' . $surat->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card multisteps-form__panel p-4 border-radius-xl bg-white js-active"
                            data-animation="FadeIn">
                            <h5 class="font-weight-bolder">Edit Surat</h5>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>NIK</label>
                                    <input type="text" value="{{ rc4_decrypt($employee->nik) }}" class="form-control"
                                        name="nik" readonly />
                                    <input type="text" value="{{ rc4_decrypt($employee->nik) }}" class="form-control"
                                        name="nik" hidden />
                                </div>
                                <div class="form-group col-4">
                                    <label>Nama</label>
                                    <input type="text" value="{{ $employee->nama }}" class="form-control" name="nama"
                                        readonly />
                                </div>
                                <div class="form-group col-4">
                                    <label>Tempat Lahir</label>
                                    <input type="text" value="{{ $employee->tempat_lahir }}" class="form-control"
                                        name="tempat_lahir" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" value="{{ $employee->tanggal_lahir }}" class="form-control"
                                        name="tanggal_lahir" readonly />
                                </div>
                                <div class=" form-group col-4">
                                    <label>Branch</label>
                                    <input type="text" value="{{ $employee->masterBranchRegulars->branch }}"
                                        class="form-control" name="group_employee" readonly />
                                </div>
                                <div class=" form-group col-4">
                                    <label>Nama PT/CV/Waralaba</label>
                                    <input type="text" value="{{ $employee->masterBranchFranchises->nama_pt }}"
                                        class="form-control" name="nama_pt" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class=" form-group col-4">
                                    <label>Nama Toko</label>
                                    <input class="form-control" type="text" value="{{ $employee->toko->nama_toko }}"
                                        name="nama_toko" readonly />
                                </div>
                                <div class="form-group col-4">
                                    <label>Pendidikan Terakhir</label>
                                    <input type="text" value="{{ $employee->pendidikan }}" class="form-control"
                                        name="pendidikan" readonly />
                                </div>
                                <div class="form-group col-4">
                                    <label>Jabatan</label>
                                    <input type="text" value="{{ $employee->jabatan }}" class="form-control"
                                        name="jabatan" readonly />
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="form-group col-4">
                                    <label>No Surat</label>
                                    <input type="text" value="{{ $employee->no_surat }}" class="form-control"
                                        name="no_surat" readonly />
                                </div>
                                <div class="form-group col-4">
                                    <label>Tanggal Awal Hubungan Kerja</label>
                                    <input type="date" value="{{ $employee->tgl_awal_hubker }}" class="form-control"
                                        name="tgl_awal_hubker" readonly />
                                </div>
                                <div class="col-4">
                                    <label>Jenis Perjanjian Kerja</label>
                                    <input type="text" value="{{ $employee->jenis_pkwt }}" class="form-control"
                                        name="jenis_pkwt" readonly />
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4">
                                    <label>Nomor Perjanjian Kerja</label>
                                    <input type="text" value="{{ $employee->no_pkwt }}" class="form-control"
                                        name="no_pkwt" readonly />
                                </div>
                                <div class="col-4">
                                    <label>Tanggal Perjanjian Kerja</label>
                                    <input type="date" value="{{ $employee->tgl_pkwt }}" class="form-control"
                                        name="tgl_pkwt" readonly />
                                </div>
                                <div class="form-group col-4">
                                    <label>Tanggal Berakhir Hubungan Kerja</label>
                                    <input type="date" value="{{ $employee->tgl_akhir_hubker }}" class="form-control"
                                        name="tgl_akhir_hubker" />
                                </div>
                            </div>


                            <div class="row-12">
                                <h5 class="font-weight-bolder">Form wajib isi</h5>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label>Jenis Surat</label>
                                    <select class="form-control" name="jenis_surat" id="jenis_surat" required
                                        aria-required="true">
                                        <option selected disabled>Pilih Salah Satu</option>
                                        <option value="Choice 1"
                                            {{ $surat->jenis_surat === 'Choice 1' ? 'selected' : '' }}>SKBHK EIR 003
                                        </option>
                                        <option value="Choice 2"
                                            {{ $surat->jenis_surat === 'Choice 2' ? 'selected' : '' }}>SKBHK EIR 004
                                        </option>
                                        <option value="Choice 3"
                                            {{ $surat->jenis_surat === 'Choice 3' ? 'selected' : '' }}>SKBHK EIR 005
                                        </option>
                                        <option value="Choice 4"
                                            {{ $surat->jenis_surat === 'Choice 4' ? 'selected' : '' }}>SKBHK EIR 006
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Alasan Berakhirnya Hubungan Kerja</label>
                                    <select class="form-control" name="alasan" id="alasan">
                                        <option selected disabled>Pilih Salah Satu</option>
                                        <option value="Choice 1" {{ $surat->alasan === 'Choice 1' ? 'selected' : '' }}>
                                            Telah meninggal dunia</option>
                                        <option value="Choice 2" {{ $surat->alasan === 'Choice 2' ? 'selected' : '' }}>
                                            Telah ditahan pihak yang berwajib</option>
                                        <option value="Choice 3" {{ $surat->alasan === 'Choice 3' ? 'selected' : '' }}>
                                            Telah melanggar peraturan perusahaan</option>
                                        <option value="Choice 4" {{ $surat->alasan === 'Choice 4' ? 'selected' : '' }}>
                                            Telah melakukan Pelanggaran bersifat mendesak</option>
                                        <option value="Choice 5" {{ $surat->alasan === 'Choice 5' ? 'selected' : '' }}>
                                            Adanya putusan lembaga penyelesaian perselisihan hubungan industrial</option>
                                        <option value="Choice 6" {{ $surat->alasan === 'Choice 6' ? 'selected' : '' }}>
                                            Telah memasuki Usia Pensiun</option>
                                        <option value="Choice 7" {{ $surat->alasan === 'Choice 7' ? 'selected' : '' }}>
                                            Mengalami sakit berkepanjangan</option>
                                        <option value="Choice 8" {{ $surat->alasan === 'Choice 8' ? 'selected' : '' }}>
                                            Telah mangkir 5 hari kerja atau lebih berturut-turut</option>
                                        <option value="Choice 9" {{ $surat->alasan === 'Choice 9' ? 'selected' : '' }}>
                                            Telah mengundurkan Diri</option>
                                        <option value="Choice 10" {{ $surat->alasan === 'Choice 10' ? 'selected' : '' }}>
                                            Bahwa Jangka waktu perjanjian kerja waktu tertentu</option>
                                        <option value="Choice 11" {{ $surat->alasan === 'Choice 11' ? 'selected' : '' }}>
                                            Bahwa masa probation(probation)</option>
                                        <option value="Choice 12" {{ $surat->alasan === 'Choice 12' ? 'selected' : '' }}>
                                            Bahwa Perusahaan melakukan Merger/ Akuisisi</option>
                                        <option value="Choice 13" {{ $surat->alasan === 'Choice 13' ? 'selected' : '' }}>
                                            Bahwa Perusahaan melakukan Efisiensi</option>
                                        <option value="Choice 14" {{ $surat->alasan === 'Choice 14' ? 'selected' : '' }}>
                                            Bahwa karena keadaan memaksa (Force majeure)</option>
                                        <option value="Choice 15" {{ $surat->alasan === 'Choice 15' ? 'selected' : '' }}>
                                            Bahwa Perusahaan mengalami Pailit</option>
                                        <option value="Choice 16" {{ $surat->alasan === 'Choice 16' ? 'selected' : '' }}>
                                            Bahwa Perusahaan mengalami kerugian</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>Jabatan Penanda Tangan</label>
                                    <select class="form-control" name="master_ttd_id" required>
                                        <option selected disabled>Pilih Jabatan</option>
                                        @foreach ($masterTtd as $ttd)
                                            <option value="{{ $ttd->id }}"
                                                {{ $ttd->id == $surat->master_ttd_id ? 'selected' : '' }}>
                                                {{ $ttd->nama }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class= "row">
                                <div class="button-row d-flex mt-4">
                                    <a href="{{ '/surat' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                        title="Submit">Edit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Kemudian sertakan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{{ session('error') }}',
                });
            @endif
        });
    </script>

    <script src="../../../assets/js/plugins/choices.min.js"></script>
    <script src="../../../assets/js/plugins/dropzone.min.js"></script>
    <script src="../../../assets/js/plugins/quill.min.js"></script>
    <script src="../../../assets/js/plugins/multistep-form.js"></script>

    <!-- Kanban scripts -->
    <script src="../../../assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="../../../assets/js/plugins/jkanban/jkanban.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../../../assets/js/argon-dashboard.min.js?v=2.0.5"></script>
    <script>
        // Mendapatkan elemen jenis_surat dan alasan
        var jenisSuratSelect = document.querySelector('select[name="jenis_surat"]');
        var alasanSelect = document.querySelector('select[name="alasan"]');

        // Fungsi untuk mengatur opsi alasan berdasarkan jenis_surat yang dipilih
        function updateAlasanOptions() {
            var jenisSuratValue = jenisSuratSelect.value;
            var alasanOptions = alasanSelect.querySelectorAll('option');

            // Semua opsi alasan disembunyikan terlebih dahulu
            alasanOptions.forEach(function(option) {
                option.style.display = 'none';
            });

            if (jenisSuratValue === 'SKBHK EIR 003' || jenisSuratValue === 'SKBHK EIR 004') {
                // Tampilkan opsi alasan dengan value 1 sampai 6
                for (var i = 1; i <= 5; i++) {
                    alasanSelect.querySelector('option[value="Choice ' + i + '"]').style.display = 'block';
                }
            } else if (jenisSuratValue === 'SKBHK EIR 005' || jenisSuratValue === 'SKBHK EIR 006') {
                // Tampilkan opsi alasan dengan value 7 sampai 14
                for (var i = 6; i <= 16; i++) {
                    alasanSelect.querySelector('option[value="Choice ' + i + '"]').style.display = 'block';
                }
            }

            // Set opsi pertama sebagai opsi yang terpilih
            alasanSelect.querySelector('option[value]:not([style*="display: none;"])').selected = true;
        }

        // Panggil fungsi saat jenis_surat berubah
        jenisSuratSelect.addEventListener('change', updateAlasanOptions);

        // Panggil fungsi saat halaman dimuat untuk mengatur opsi awal
        updateAlasanOptions();
    </script>
    <script>
        // Mendapatkan elemen jenis_surat dan alasan
        var jenisSuratSelect = document.querySelector('select[name="jenis_surat"]');
        var alasanSelect = document.querySelector('select[name="alasan"]');

        // Fungsi untuk mengatur opsi alasan berdasarkan jenis_surat yang dipilih
        function updateAlasanOptions() {
            var jenisSuratValue = jenisSuratSelect.value;
            var alasanOptions = alasanSelect.options;

            // Semua opsi alasan disembunyikan terlebih dahulu
            for (var i = 0; i < alasanOptions.length; i++) {
                alasanOptions[i].style.display = 'none';
            }

            if (jenisSuratValue === 'Choice 1' || jenisSuratValue === 'Choice 2') {
                // Tampilkan opsi alasan dengan value 1 sampai 6
                for (var i = 0; i < 6; i++) {
                    alasanOptions[i].style.display = 'block';
                }
            } else if (jenisSuratValue === 'Choice 3' || jenisSuratValue === 'Choice 4') {
                // Tampilkan opsi alasan dengan value 7 sampai 14
                for (var i = 6; i < alasanOptions.length; i++) {
                    alasanOptions[i].style.display = 'block';
                }
            }
        }

        // Panggil fungsi saat jenis_surat berubah
        jenisSuratSelect.addEventListener('change', updateAlasanOptions);

        // Panggil fungsi saat halaman dimuat untuk mengatur opsi awal
        updateAlasanOptions();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.getElementById('jenis_surat');

            selectElement.addEventListener('invalid', function() {
                // Tampilkan pesan kesalahan jika elemen tidak valid
                selectElement.setCustomValidity('Please select a valid option');
            });

            selectElement.addEventListener('input', function() {
                // Hapus pesan kesalahan jika pengguna memilih opsi
                selectElement.setCustomValidity('');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectAlasan = document.getElementById('alasan');

            selectAlasan.addEventListener('invalid', function() {
                // Tampilkan pesan kesalahan jika elemen alasan tidak valid
                selectAlasan.setCustomValidity('Please select a valid option');
            });

            selectAlasan.addEventListener('input', function() {
                // Hapus pesan kesalahan jika pengguna memilih salah satu opsi
                selectAlasan.setCustomValidity('');
            });
        });
    </script>


@endsection
