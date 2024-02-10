@section('title', 'Master Data Ttd')
@section('pages1', 'Master Data')
@section('pages2', 'Edit TTD')
@extends('/layouts/master')
@section('content')
    <div class="multisteps-form">
        <div class="row">
            <div class="col-10 col-lg-8 mx-auto mt-0 mb-sm-1 mb-5">
                <div class="multisteps-form__progress">
                </div>
            </div>
        </div>
        <!--form panels-->
        <div class="row p-3">
            <div class="col-12 col-lg-8 m-auto">
                <form class="multisteps-form__form mb-1" action="{{ url('admin/editttd/' . $masterttd->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active" data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Edit TTD</h5>
                        <div class="row pb-3">
                            <div class="col-12">
                                <label>Branch</label>
                                <select class="form-control" name="master_branch_regulars_id">
                                    <option selected disabled>Pilih Branch</option>
                                    @foreach ($masterbranchregulars as $branch)
                                        <option value="{{ $branch->id }}"
                                            {{ $masterttd->master_branch_regulars_id == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->branch }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-12">
                                <label>Nama</label>
                                <input id="nama" type="text"
                                    class="multisteps-form__input form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ $masterttd->nama }}"required autocomplete="nama"
                                    placeholder="eg. Off-White" autofocus />
                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="col-12">
                                <label>Jabatan</label>
                                <input id="jabatan" type="text"
                                    class="multisteps-form__input form-control @error('jabatan') is-invalid @enderror"
                                    name="jabatan" value="{{ $masterttd->jabatan }}"required autocomplete="jabatan"
                                    placeholder="eg. Off-White" autofocus />
                                @error('tempat_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row pb-3">
                            <div class="button-row d-flex mt-0">
                                <a href="{{ '/admin/masterttd' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                                <button class="btn bg-gradient-dark ms-auto mb-0" type="submit"
                                    title="Submit">submit</button>
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
