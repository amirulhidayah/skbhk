@section('title', 'Master Data Karyawan')
@section('pages1', 'Master Data')
@section('pages2', 'Karyawan')
@extends('/layouts/master')
@section('content')
    <div class="col-12">
        <div class="card">
            <!-- Card header -->
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Data Karyawan</h5>
                        <p class="text-sm mb-0">
                            Informasi terkait Karyawan
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href={{ url('admin/tambahkaryawan') }} class="btn bg-gradient-info btn-sm mb-0">+&nbsp;
                                tambah</a>
                            <button type="button" class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal"
                                data-bs-target="#import">
                                Import
                            </button>
                            <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog mt-lg-10">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Import Excel</h5>
                                            <i class="fas fa-upload ms-3"></i>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/admin/importkaryawan') }}" method="post"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="file" class="form-label">Pilih file Excel</label>
                                                    <input type="file" class="form-control" id="file" name="file"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="importCheck"
                                                            id="importCheck" checked>
                                                        I accept the terms and conditions
                                                    </label>
                                                </div>
                                                <button type="submit"
                                                    class="btn bg-gradient-primary btn-sm">Upload</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn bg-gradient-secondary btn-sm"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="table-responsive">
                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Branch</th>
                                <th>Status Branch</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nourut = 1; ?>
                            @foreach ($karyawan->reverse() as $item)
                                <tr class="thead-light">
                                    <td>{{ $nourut++ }}</td>
                                    <td>{{ rc4_decrypt($item->nik) }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->masterBranchRegulars->branch }}</td>
                                    <td>
                                        @if ($item->masterBranchRegulars)
                                            @if ($item->masterBranchRegulars->status == 1)
                                                Aktif
                                            @else
                                                Tidak Aktif
                                            @endif
                                        @else
                                            No Status
                                        @endif
                                    </td>
                                    <td class="text-sm">
                                        <a href={{ '/admin/editkaryawan/' . $item->id }} data-bs-toggle="tooltip"
                                            class="badge badge-success edit-surat">Edit</a>
                                        <a href="javascript::void(0)" class="badge badge-danger delete-user"
                                            data-id="{{ $item->id }}">Hapus</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.5') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables.js') }}"></script>
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
    <script>
        //sweetalert untuk hapus
        $(document).on('click', '.delete-user', function() {
            const karyawanId = $(this).attr('data-id');

            Swal.fire({
                title: 'Anda yakin ingin menghapus karyawan ini?',
                text: 'Aksi ini tidak dapat dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete route with the user ID
                    window.location.href = `/admin/hapuskaryawan/${karyawanId}`;
                }
            });
        })
    </script>
    <script>
        if (document.getElementById('products-list')) {
            const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
                searchable: true,
                fixedHeight: false,
                perPage: 7
            });

            document.querySelectorAll(".export").forEach(function(el) {
                el.addEventListener("click", function(e) {
                    var type = el.dataset.type;

                    var data = {
                        type: type,
                        filename: "soft-ui-" + type,
                    };

                    if (type === "csv") {
                        data.columnDelimiter = "|";
                    }

                    dataTableSearch.export(data);
                });
            });
        };
    </script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.5') }}"></script>
@endsection

<script>
    //sweetalert untuk hapus
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-user');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const karyawanId = button.getAttribute('data-id');

                Swal.fire({
                    title: 'Anda yakin ingin menghapus user ini?',
                    text: 'Aksi ini tidak dapat dibatalkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to the delete route with the user ID
                        window.location.href = `/admin/hapuskaryawan/${karyawanId}`;
                    }
                });
            });
        });
    });
</script>
