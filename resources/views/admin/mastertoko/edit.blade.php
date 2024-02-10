@section('title', 'Master Toko ')
@section('pages1', 'Master Data')
@section('pages2', 'Toko')
@extends('/layouts/master')
@section('content')
    <!-- End Navbar -->
    <div class="multisteps-form">
        <div class="row">
            <div class="col-10 col-lg-8 mx-auto mt-0 mb-sm-6 mb-3">
                <div class="multisteps-form__progress">
                </div>
            </div>
        </div>
        <!--form panels-->
        <div class="row">
            <div class="col-8 col-lg-8 m-auto">
                <form class="multisteps-form__form mb-1" action="{{ url('admin/edittoko/' . $mastertoko->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                        data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Edit Toko</h5>
                        <div class="multisteps-form__content">
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <label>Nama Toko</label>
                                    <input id="Nama Toko" type="text"
                                        class="multisteps-form__input form-control @error('name') is-invalid @enderror"
                                        name="nama_toko" value="{{ $mastertoko->nama_toko }}" placeholder="eg. Off-White"
                                        autofocus />

                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Alamat Toko</label>
                                    <input id="alamat_toko"
                                        class="multisteps-form__input form-control @error('alamat_toko') is-invalid @enderror"
                                        name="alamat" value="{{ $mastertoko->alamat }}" placeholder="Jl. Manimbaya" />
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>PT/CV/Waralaba</label>
                                    <select class="form-control" name="master_branch_franchises_id">
                                        <option value="">Pilih PT/CV/Waralaba</option>
                                        @foreach ($masterBranchFranchise as $namapt)
                                            <option value="{{ $namapt->id }}"
                                                {{ $namapt->id == $mastertoko->masterBranchFranchise->id ? 'selected' : '' }}>
                                                {{ $namapt->nama_pt }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="button-row d-flex mt-4">
                                <a href="{{ '/admin/masteruser' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                                <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Submit">Edit
                                    Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Sertakan jQuery terlebih dahulu -->
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
        <!-- ... Bagian setelahnya ... -->

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
        <!-- Pastikan Anda telah memasang SweetAlert2 dan jQuery di proyek Anda -->

    @endsection
