@section('title', 'Master Data Branch Franchise')
@section('pages1', 'Master Data')
@section('pages2', 'Branch Franchise')
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
                <form class="multisteps-form__form mb-1" action="{{ url('admin/tambahbranchfranchise') }}" method="POST">
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-4 border-radius-xl bg-white js-active" data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Tambah Branch Franchise</h5>
                        <div class="row pb-4">
                            <div class="col-6 ">
                                <label>Nama PT/CV/Waralaba</label>
                                <input id="nama_pt" type="text"
                                    class="multisteps-form__input form-control @error('nama_pt') is-invalid @enderror"
                                    name="nama_pt" value="{{ old('nama_pt') }}"required autocomplete="nama_pt"
                                    placeholder="PT. Suka Maju" autofocus />
                            </div>
                            <div class="col-6">
                                <label>Alamat</label>
                                <input id="alamat" type="text"
                                    class="multisteps-form__input form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ old('alamat') }}"required autocomplete="alamat"
                                    placeholder="Alfa Tower- Jl.Jalur Sutera Barat kav.9 Alam Sutera, Tanggerang 15143"
                                    autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label>No. Telepon</label>
                                <input id="no_telp" type="text"
                                    class="multisteps-form__input form-control @error('no_telp') is-invalid @enderror"
                                    name="no_telp" value="{{ old('no_telp') }}"required autocomplete="no_telp"
                                    placeholder="021-808 21 555" autofocus />
                            </div>
                            <div class="col-6">
                                <label>No. Fax</label>
                                <input id="no_fax" type="text"
                                    class="multisteps-form__input form-control @error('no_fax') is-invalid @enderror"
                                    name="no_fax" value="{{ old('no_fax') }}" autocomplete="no_fax"
                                    placeholder="021-808 21 556" autofocus />
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <a href="{{ '/admin/masterbranchfranchise' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Submit">Simpan</button>
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
