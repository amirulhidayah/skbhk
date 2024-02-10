@section('title', 'Dashboard Admin')
@section('pages1', 'Admin')
@section('pages2', 'Data User')
@extends('/layouts/master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header pb-0">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">Data User</h5>
                            <p class="text-sm mb-0">
                                Informasi terkait akun user
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0 mt-4">
                            <div class="ms-auto my-auto">
                                <a href={{ url('/admin/tambahuser') }}
                                    class="btn bg-gradient-info btn-sm mb-0">+&nbsp;Tambah</a>
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
                                    <th>Nama</th>
                                    <th>Branch</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $nourut = 1; ?>
                                @foreach ($masteruser->reverse() as $item)
                                    <tr class="thead-light">
                                        <td>{{ $nourut++ }}</td>
                                        <td>{{ $item?->name }}</td>
                                        <td>{{ $item?->master_branch_regulars_id ? $item?->masterBranchRegulars?->branch : 'N/A' }}
                                        </td>
                                        <td>{{ $item?->email }}</td>
                                        <td>{{ $item?->role_as == '1' ? 'Super Admin' : 'User' }}</td>
                                        <td>
                                            <a href={{ '/admin/edituser/' . $item->id }} data-bs-toggle="tooltip"
                                                class="badge badge-success">Edit</a>
                                            <a class="badge badge-danger delete-user"
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
    </div>
    </div>

    <!--   Core JS Files   -->

    <script src="../../../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../../../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../../../assets/js/plugins/datatables.js"></script>
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
    <!-- Kanban scripts -->
    <script src="../../../assets/js/plugins/dragula/dragula.min.js"></script>
    <script src="../../../assets/js/plugins/jkanban/jkanban.js"></script>
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
    <script src="../../../assets/js/argon-dashboard.min.js?v=2.0.5"></script>
@endsection

<script>
    //sweetalert untuk hapus
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-user');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = button.getAttribute('data-id');

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
                        Swal.fire('Akun Dihapus', 'Akun telah berhasil dihapus!',
                                'success')
                            .then(() => {
                                window.location.href = `/admin/hapususer/${userId}`;
                            });
                    }
                });
            });
        });
    });
</script>
