@section('title', 'Master Data Toko')
@section('pages1', 'Master Data')
@section('pages2', 'Toko')
@extends('/layouts/master')
@section('content')
    <div class="multisteps-form">
        <div class="row">
            <div class="col-10 col-lg-8 mx-auto mt-5 mb-sm-1 mb-3">
                <div class="multisteps-form__progress">
                </div>
            </div>
        </div>
        <!--form panels-->
        <div class="row">
            <div class="col-12 col-lg-11 m-auto">
                <form class="multisteps-form__form mb-1" action="{{ url('admin/tambahtoko') }}" method="POST">
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-4 border-radius-xl bg-white js-active" data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Tambah Toko</h5>
                        <div class="row pb-4">
                            <div class="col-4 col-sm-4 mt-10 mt-sm-0">
                                <label>Nama Toko</label>
                                <input id="branch" type="text"
                                    class="multisteps-form__input form-control @error('nama_toko') is-invalid @enderror"
                                    name="nama_toko" value="{{ old('nama_toko') }}"required autocomplete="nama_toko"
                                    placeholder="Jaya Abadi" autofocus />
                            </div>
                            <div class="col-4">
                                <label>Alamat Toko</label>
                                <input id="alamat" type="text"
                                    class="multisteps-form__input form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ old('alamat') }}"required autocomplete="alamat"
                                    placeholder="Jl Suka Maju" autofocus />
                            </div>
                            <div class="col-4">
                                <label>Nama PT/CV/Waralaba</label>
                                <select class="form-control" name="master_branch_franchises_id">
                                    <option value="">Pilih PT/CV/Waralaba</option>
                                    @foreach ($masterBranchFranchise as $namapt)
                                        <option value="{{ $namapt->id }}">{{ $namapt->nama_pt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="button-row d-flex mt-4">
                            <a href="{{ '/admin/mastertoko' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Submit">submit</button>
                        </div>
                    </div>
                </form>
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
    @endsection
