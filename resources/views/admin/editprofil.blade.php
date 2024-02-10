@section('title', 'Dashboard Admin')
@section('pages1', 'Admin')
@section('pages2', 'Data User')
@extends('layouts.master')
@section('content')
    <!-- End Navbar -->
    <div class="multisteps-form">
        <div class="row">
            <div class="col-10 col-lg-8 mx-auto mt-0 mb-sm-6 mb-3">
                <div class="multisteps-form__progress"></div>
            </div>
        </div>
        <!--form panels-->
        <div class="row">
            <div class="col-8 col-lg-8 m-auto">
                <form class="multisteps-form__form mb-1" action="{{ url('admin/editprofil') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!--single form panel-->
                    <div class="card multisteps-form__panel p-3 border-radius-xl bg-white js-active"
                        data-animation="FadeIn">
                        <h5 class="font-weight-bolder">Edit User</h5>
                        <div class="multisteps-form__content">
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6">
                                    <label>Nama</label>
                                    <input id="name" type="text"
                                        class="multisteps-form__input form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{ $user->name }}" placeholder="eg. Off-White" autofocus />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Email</label>
                                    <input id="email"
                                        class="multisteps-form__input form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ $user->email }}" placeholder="123@sat.co.id" />
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
                                    <select class="form-control" name="branch">
                                        <option selected disabled>Pilih Branch</option>
                                        @foreach ($masterBranchRegulers as $branch)
                                            <option value="{{ $branch->branch }}">{{ $branch->branch }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if ($user->password)
                                    <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                        <label>Password Lama</label>
                                        <input id="password" type="password"
                                            class="multisteps-form__input form-control @error('password') is-invalid @enderror"
                                            name="password" placeholder="Password Lama" />
                                    </div>
                                @endif
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Password Baru</label>
                                    <input id="new_password" type="password" class="multisteps-form__input form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Password Baru"/>
                                    @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                    <label>Konfirmasi Password Baru</label>
                                    <input id="new_password_confirmation" type="password" class="multisteps-form__input form-control" name="new_password_confirmation" placeholder="Konfirmasi Password Baru"/>
                                </div>
                            </div>
                            <div class="button-row d-flex mt-4">
                                <a href="{{ '/admin/dashboard' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
                                <button class="btn bg-gradient-dark ms-auto mb-0" type="submit" title="Submit">Edit
                                    Profile</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--admin/editprofil.blade.php-->
    <!-- ... Bagian sebelumnya ... -->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
