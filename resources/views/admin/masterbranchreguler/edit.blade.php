@section('title', 'Master Data Branch Reguler')
@section('pages1', 'Master Data Branch Reguler')
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
                <form class="multisteps-form__form mb-1"
                    action="{{ url('admin/editbranchreguler/' . $masterbranchregulars->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-4 border-radius-xl bg-white js-active" data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Edit Branch Reguler</h5>
                        <div class="row pb-4">
                            <div class="col-4 col-sm-4 mt-10 mt-sm-0">
                                <label>Branch</label>
                                <input id="branch" type="text"
                                    class="multisteps-form__input form-control @error('branch') is-invalid @enderror"
                                    name="branch" value="{{ $masterbranchregulars->branch }}" required
                                    autocomplete="branch" placeholder="Head Office" autofocus />
                            </div>
                            <div class="col-8">
                                <label>Alamat</label>
                                <input id="alamat" type="text"
                                    class="multisteps-form__input form-control @error('alamat') is-invalid @enderror"
                                    name="alamat" value="{{ $masterbranchregulars->alamat }}"required autocomplete="alamat"
                                    placeholder="Alfa Tower- Jl.Jalur Sutera Barat kav.9 Alam Sutera, Tanggerang 15143"
                                    autofocus />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>no_telp</label>
                                <input id="no_telp" type="text"
                                    class="multisteps-form__input form-control @error('no_telp') is-invalid @enderror"
                                    name="no_telp" value="{{ $masterbranchregulars->no_telp }}" required
                                    autocomplete="no_telp" placeholder="021-808 21 555" autofocus />
                            </div>
                            <div class="col-4">
                                <label>no_fax</label>
                                <input id="no_fax" type="text"
                                    class="multisteps-form__input form-control @error('no_fax') is-invalid @enderror"
                                    name="no_fax"value="{{ $masterbranchregulars->no_fax }}" autocomplete="no_fax"
                                    placeholder="021-808 21 556" autofocus />
                            </div>
                            <div class="col-4">
                                <label>kota/Kab</label>
                                <input id="kota" type="text"
                                    class="multisteps-form__input form-control @error('kota') is-invalid @enderror"
                                    name="kota" value="{{ $masterbranchregulars->kota }}" required autocomplete="kota"
                                    placeholder="Tanggerang" autofocus />
                            </div>
                        </div>
                        <div class="button-row d-flex mt-4">
                            <a href="{{ '/admin/masterbranchreguler' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Submit">submit</button>
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
    @endsection
