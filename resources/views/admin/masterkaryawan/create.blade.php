@section('title', 'Master Data Karyawan')
@section('pages1', 'Master Data')
@section('pages2', 'Karyawan')
@extends('/layouts/master')
@section('content')
    <div class="multisteps-form">
        <div class="row">
            <div class="col-10 col-lg-8 mx-auto mt-0 mb-sm-1 mb-3">
                <div class="multisteps-form__progress">
                </div>
            </div>
        </div>
        <!--form panels-->
        <div class="row">
            <div class="col-12 col-lg-11 m-auto">
                <form class="multisteps-form__form mb-1" action="{{ url('admin/tambahkaryawan') }}" method="POST">
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Tambah Karyawan</h5>
                        <div class="row pb-3">
                            <div class="col-4">
                                <label>NIK</label>
                                <input id="nik" type="text"
                                    class="multisteps-form__input form-control @error('nik') is-invalid @enderror"
                                    name="nik" value="{{ old('nik') }}"autocomplete="nik" autofocus />
                                @error('nik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label>Nama</label>
                                <input id="nama" type="text"
                                    class="multisteps-form__input form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama') }}"autocomplete="nama"
                                    placeholder="eg. Off-White" autofocus />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label>Tempat Lahir</label>
                                <input id="tempat_lahir" type="text"
                                    class="multisteps-form__input form-control @error('tempat_lahir') is-invalid @enderror"
                                    name="tempat_lahir" value="{{ old('tempat_lahir') }}" autocomplete="tempat_lahir"
                                    placeholder="eg. Off-White" autofocus />
                                @error('tempat_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-4">
                                <label>Tanggal Lahir</label>
                                <input id="tanggal_lahir" type="date"
                                    class="multisteps-form__input form-control @error('tanggal_lahir') is-invalid @enderror"
                                    name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" autocomplete="tanggal_lahir"
                                    placeholder="eg. Off-White" autofocus />
                                @error('tanggal_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" name="pendidikan" id="choices-category">
                                    <option selected="">Pilih Salah Satu</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="MTS">MTS</option>
                                    <option value="SMA">SMA</option>
                                    <option value="SLTA">SLTA</option>
                                    <option value="SMK">SMK</option>
                                    <option value="MA">MA</option>
                                    <option value="S1 (Strata 1)">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Jabatan</label>
                                <input id="jabatan" type="text"
                                    class="multisteps-form__input form-control @error('jabatan') is-invalid @enderror"
                                    name="jabatan" value="{{ old('jabatan') }}"autocomplete="tanggal_lahir"
                                    placeholder="eg. Off-White" autofocus />
                                @error('jabatan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-4">
                                <label>Branch</label>
                                <select class="form-control" name="master_branch_regulars_id">
                                    <option selected disabled>Pilih Branch</option>
                                    @foreach ($masterBranchRegulars as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Nama PT**</label>
                                <select class="form-control" name="master_branch_franchises_id"
                                    id="master_branch_franchises_id"
                                    style="  border-color:brown;
                                color: #333;">
                                    <option value="">Pilih PT/CV/Waralaba</option>
                                    @foreach ($masterBranchFranchises as $nama_ptcv)
                                        <option value="{{ $nama_ptcv->id }}">{{ $nama_ptcv->nama_pt }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Nama Toko**</label>
                                <select class="form-control" name="toko_id" id="toko_id"
                                    style="  border-color:brown;
                                color: #333;">
                                    <option value="">Pilih Toko</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-4">
                                <label>No Surat</label>
                                <input class="multisteps-form__input form-control" type="text" placeholder="7 Juli 2023"
                                    name="no_surat" />
                            </div>
                            <div class="col-4">
                                <label>Tanggal Awal Hubungan Kerja</label>
                                <input class="multisteps-form__input form-control" type="date"
                                    placeholder="10 Januari 2012" name="tgl_awal_hubker" />
                            </div>
                            <div class="col-4">
                                <label>Tanggal Berakhir Hubungan Kerja</label>
                                <input class="multisteps-form__input form-control" type="date"
                                    placeholder="7 Juli 2023" name="tgl_akhir_hubker" />
                            </div>
                        </div>
                        <div class="row pb-3">
                            <!-- Kolom-kolom yang sudah ada sebelumnya ... -->
                            <!-- ... -->
                            <div class="col-4">
                                <label for="">Jenis Perjanjian Kerja**</label>
                                <select class="form-control" name="jenis_pkwt" id="choices-category"
                                    style="  border-color:brown;
                              color: #333;">
                                    <option value="">Pilih Jenis Perjanjian Kerja</option>
                                    <option value="PKWT">PKWT</option>
                                    <option value="PKWTT">PKWTT</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Nomor Perjanjian Kerja**</label>
                                <input class="multisteps-form__input form-control" type="text" placeholder="001"
                                    style="  border-color:brown;
                                color: #333;"
                                    name="no_pkwt" value="{{ old('no_pkwt') }}" />
                            </div>
                            <div class="col-4">
                                <label>Tanggal Perjanjian Kerja**</label>
                                <input class="multisteps-form__input form-control" type="date"
                                    style="  border-color:brown;
                                color: #333;"
                                    placeholder="7 Juli 2023" name="tgl_pkwt" value="{{ old('tgl_pkwt') }}" />
                            </div>
                        </div>
                        <div>
                            <label> Noted: <br>
                                ** : Wajib isi untuk SKBHK Franchise</label>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <a href="{{ '/admin/masterkaryawan' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                title="Submit">submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            $(document).ready(function() {
                // Menonaktifkan opsi "Pilih Salah Satu" setelah pilihan pertama
                $('#choices-category').change(function() {
                    if ($(this).val() === '') {
                        $(this).prop('disabled', true);
                    }
                });
            });
        </script>

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

            $('#master_branch_franchises_id').change(function() {
                const id = $(this).val();
                $('#toko_id').html('');
                $('#toko_id').append(
                    `<option value="">Pilih Toko</option>`);
                $.ajax({
                    type: "GET",
                    url: "{{ url('list/toko') }}",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        result.data.map((toko) => {
                            $('#toko_id').append(
                                `<option value="${toko.id}">${toko.nama_toko}</option>`);
                        })
                    }
                })
            })
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
    @endsection
