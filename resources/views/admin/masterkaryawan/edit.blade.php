@section('title', 'Master Data Karyawan')
@section('pages1', 'Master Karyawan')
@section('pages2', 'Edit')
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
                <form class="multisteps-form__form mb-1" action="{{ url('admin/editkaryawan/' . $karyawan->id) }}"
                    method="POST">
                    @method('PUT')
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                        <h5 class="font-weight-bolder">edit Karyawan</h5>
                        <div class="row">
                            <div class="col-4">
                                <label>NIK (Nomor Induk Karyawan)</label>
                                <input id="nik" type="text"
                                    class="multisteps-form__input form-control @error('nik') is-invalid @enderror"
                                    name="nik" value="{{ $karyawan->nik }}" autocomplete="nik" autofocus />
                            </div>
                            <div class="col-4">
                                <label>Nama</label>
                                <input id="nama" type="text"
                                    class="multisteps-form__input form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ $karyawan->nama }}" required autocomplete="nama"
                                    placeholder="eg. Off-White" autofocus />
                            </div>
                            <div class="col-4">
                                <label>Tempat Lahir</label>
                                <input id="tempat_lahir" type="text"
                                    class="multisteps-form__input form-control @error('tempat_lahir') is-invalid @enderror"
                                    name="tempat_lahir" value="{{ $karyawan->tempat_lahir }}" required
                                    autocomplete="tempat_lahir" placeholder="eg. Off-White" autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Tanggal Lahir</label>
                                <input id="tanggal_lahir" type="date"
                                    class="multisteps-form__input form-control @error('tanggal_lahir') is-invalid @enderror"
                                    name="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}" required
                                    autocomplete="tanggal_lahir" placeholder="eg. Off-White" autofocus />
                            </div>
                            <div class="col-4">
                                <label>Pendidikan Terakhir</label>
                                <select class="form-control" name="pendidikan">
                                    <option selected disabled>Pilih Pendidikan</option>
                                    <?php $kategori = ['SD', 'SMP', 'MTS', 'SMA', 'SMK', 'SLTA', 'MA', 'S1', 'S2', 'S3']; ?>


                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat }}"
                                            {{ $karyawan->pendidikan == $kat ? 'selected' : '' }}>
                                            {{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Jabatan</label>
                                <input id="jabatan" type="text"
                                    class="multisteps-form__input form-control @error('jabatan') is-invalid @enderror"
                                    name="jabatan" value="{{ $karyawan->jabatan }}" required autocomplete="jabatan"
                                    autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Branch</label>
                                <select class="form-control" name="master_branch_regulars_id">
                                    <option disabled>Pilih Branch</option>
                                    @foreach ($masterBranchRegulars as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $branch->id == $karyawan->master_branch_regulars_id ? 'selected' : '' }}>
                                            {{ $branch->branch }}</option>
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
                                        <option value="{{ $nama_ptcv->id }}"
                                            {{ $nama_ptcv->id == $karyawan->master_branch_franchises_id ? 'selected' : '' }}>
                                            {{ $nama_ptcv->nama_pt }}</option>
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
                                <input class="multisteps-form__input form-control" value="{{ $karyawan->no_surat }}"
                                    type="text" placeholder="7 Juli 2023" name="no_surat" />
                            </div>
                            <div class="col-4">
                                <label>Tanggal Awal Hubungan Kerja</label>
                                <input class="multisteps-form__input form-control" value="{{ $karyawan->tgl_awal_hubker }}"
                                    type="date" placeholder="10 Januari 2012" name="tgl_awal_hubker" />
                            </div>
                            <div class="col-4">
                                <label>Tanggal Berakhir Hubungan Kerja</label>
                                <input class="multisteps-form__input form-control" type="date"
                                    value="{{ $karyawan->tgl_akhir_hubker }}" placeholder="7 Juli 2023"
                                    name="tgl_akhir_hubker" />
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-4">
                                <label>Jenis Perjanjian Kerja</label>
                                <select class="form-control" name="jenis_pkwt">
                                    <option value="">Pilih Jenis Perjanjian Kerja</option>
                                    <?php $kategori = ['PKWT', 'PKWTT']; ?>
                                    @foreach ($kategori as $kat)
                                        <option value="{{ $kat }}"
                                            {{ $karyawan->jenis_pkwt == $kat ? 'selected' : '' }}>
                                            {{ $kat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Nomor Perjanjian Kerja</label>
                                <input class="multisteps-form__input form-control" type="text" placeholder="001"
                                    name="no_pkwt" value="{{ $karyawan->no_pkwt }}" />
                            </div>
                            <div class="col-4">
                                <label>Tanggal Perjanjian Kerja</label>
                                <input class="multisteps-form__input form-control" type="date"
                                    placeholder="7 Juli 2023" name="tgl_pkwt" value="{{ $karyawan->tgl_pkwt }}" />
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <a href="{{ '/admin/masterkaryawan' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Submit">Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>



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
            $(document).ready(function() {
                $('#master_branch_franchises_id').change();
                $('#nik').val("{{ rc4_decrypt($karyawan->nik) }}");
            });

            $('#master_branch_franchises_id').change(function() {
                const id = $(this).val();
                const idToko = "{{ $karyawan->toko_id }}";
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
                        if (idToko) $('#toko_id').val(idToko ?? '').trigger('change');
                    }
                })
            })
        </script>
    @endsection
