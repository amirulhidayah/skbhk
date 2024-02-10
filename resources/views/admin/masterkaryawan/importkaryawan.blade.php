{{-- 
@extends('layouts.master')
@section('title', 'Import Karyawan')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Import Karyawan</div>
                    <div class="panel-body">
                        <!-- Isi formulir atau konten lainnya untuk halaman import karyawan -->
                        <!-- Pastikan formulir ini sesuai dengan kebutuhan Anda -->
                        <form action="{{ url('/admin/importkaryawan') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Isi formulir untuk upload file Excel -->
                            <input type="file" name="file" required>
                            <button type="submit">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
