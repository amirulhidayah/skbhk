@section('title', 'Dashboard Admin')
@section('pages1', 'Admin')
@section('pages2', 'Data User')
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
                <form class="multisteps-form__form mb-1" action="{{ url('admin/tambahuser') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                        data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Tambah User</h5>
                        <div class="multisteps-form__content">
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <label>Nama</label>
                                    <input id="name" type="text"
                                        class="multisteps-form__input form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ old('name') }}"required autocomplete="name"
                                        placeholder="eg. Off-White" autofocus />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Email</label>
                                    <input id="email" type="text"
                                        class="multisteps-form__input form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}"required autocomplete="email"
                                        placeholder="123@sat.co.id" />
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Branch</label>
                                    <select class="form-control" name="master_branch_regulars_id">
                                        <option selected disabled>Pilih Branch</option>
                                        @foreach ($masterBranchRegulars as $namabranch)
                                            <option value="{{ $namabranch->id }}">{{ $namabranch->branch }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Role</label>
                                    <select class="form-control" name="role_as">
                                        <option value="">Pilih Role</option>
                                        <option value="1">Super Admin</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Password</label>
                                        <input id="password" type="password"
                                            class="multisteps-form__input form-control @error('password') is-invalid @enderror"
                                            name="password" value="{{ old('password') }}" "required autocomplete="email">
                                            </div>
                                            <div class="col-12 col-sm-6">
                                                <label>Confirm Password</label>
                                                <input id="password-confirm" type="password" class="multisteps-form__input form-control" name="password_confirmation" value="{{ old('password') }}">
                                            </div>
                                        </div>
                                        <div class="button-row d-flex mt-4">
                                            <a href="{{ '/admin/masteruser' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                                            <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Submit">Daftar Akun</button>
                                        </div>
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
