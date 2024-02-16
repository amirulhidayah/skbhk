@section('title', 'Master Data Branch Reguler')
@section('pages1', 'Master Data')
@section('pages2', 'Branch Reguler')
@extends('/layouts/master')
@section('content')
    <div class="col-12">
        <div class="card">
            <!-- Card header -->
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Data Branch Reguler</h5>
                        <p class="text-sm mb-0">
                            Informasi terkait Branch Reguler
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href={{ url('admin/tambahbranchreguler') }} class="btn bg-gradient-info btn-sm mb-0">+&nbsp;
                                Tambah</a>
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
                                <th>Branch</th>
                                {{-- <th>Alamat</th> --}}
                                <th>No Telp</th>
                                <th>No Fax</th>
                                <th>Kota</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nourut = 1; ?>
                            @foreach ($masterbranchregulars->reverse() as $item)
                                <tr class="thead-light">
                                    <td>{{ $nourut++ }}</td>
                                    <td>{{ $item->branch }}</td>
                                    {{-- <td>{{$item->alamat}}</td> --}}
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->no_fax }}</td>
                                    <td>{{ $item->kota }}</td>
                                    <td class="text-sm">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input status-checkbox" type="checkbox"
                                                    id="status_{{ $item->id }}" data-id="{{ $item->id }}"
                                                    name="status" value="1" {{ $item->status ? 'checked' : '' }}>
                                                <label class="form-check-label" for="status_{{ $item->id }}"
                                                    id="status_label_{{ $item->id }}">
                                                    {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                                                </label>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="text-sm">
                                        <a href={{ '/admin/editbranchreguler/' . $item->id }} data-bs-toggle="tooltip"
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
    <!-- resources/views/admin/masterbranchreguler/index.blade.php -->
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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusCheckboxes = document.querySelectorAll('.status-checkbox');

            statusCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const id = this.getAttribute('data-id');
                    const statusLabel = document.getElementById(`status_label_${id}`);
                    const statusText = this.checked ? 'Aktif' : 'Tidak Aktif';

                    axios.patch(`/admin/masterbranchreguler/${id}/update-status`, {
                            status: this.checked
                        })
                        .then(response => {
                            // Handle success, jika diperlukan
                            statusLabel.textContent = statusText;

                            // Perbarui nilai status di elemen HTML
                            this.setAttribute('checked', response.data.status);
                        })
                        .catch(error => {
                            // Handle error, jika diperlukan
                            console.error(error);
                        });
                });
            });
        });
    </script>

    <script>
        //sweetalert untuk hapus
        $(document).on('click', '.delete-user', function() {
            const karyawanId = $(this).attr('data-id');
            Swal.fire({
                title: 'Anda yakin ingin menghapus branch reguler ini?',
                text: 'Aksi ini tidak dapat dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the delete route with the user ID
                    window.location.href =
                        `/admin/hapusbranchreguler/${karyawanId}`;
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
