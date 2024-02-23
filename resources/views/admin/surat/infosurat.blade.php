@section('title', 'Surat SKBHK')
@section('pages1', 'Admin')
@section('pages2', 'Surat SKBHK')
@extends('/layouts/master')
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <div class="col-12">
        <div class="card">
            <!-- Card header -->
            <div class="card-header pb-0">
                <div class="d-lg-flex">
                    <div>
                        <h5 class="mb-0">Data Surat SKBHK</h5>
                        <p class="text-sm mb-0">
                            Informasi terkait Surat SKBHK yang Telah Dibuat
                        </p>
                    </div>
                    <div class="ms-auto my-auto mt-lg-0 mt-4">
                        <div class="ms-auto my-auto">
                            <a href={{ url('admin/surat') }} class="btn bg-gradient-info btn-sm mb-0">+&nbsp; Tambah</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
                <div class="table-responsive">
                    <table class="table table-flush" id="products-list">
                        <thead class="thead-light" align="center">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Pembuat Surat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $nourut = 1; ?>
                            @foreach ($surat->reverse() as $item)
                                <tr class="thead-light">
                                    <td class="small">{{ $nourut++ }}</td>
                                    <td class="small">{{ $item->karyawan->nama }}</td>
                                    <td class="small">
                                        @if ($item->jenis_surat == 'Choice 1')
                                            SKHBK 003
                                        @elseif ($item->jenis_surat == 'Choice 2')
                                            SKHBK 004
                                        @elseif ($item->jenis_surat == 'Choice 3')
                                            SKHBK 005
                                        @elseif ($item->jenis_surat == 'Choice 4')
                                            SKHBK 006
                                        @endif
                                    </td>
                                    <td class="small">
                                        {{ Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y', 'Do MMMM Y') }}
                                    </td>
                                    <td class="small">{{ $item->user ? $item->user->name : 'Tidak ada informasi editor' }}
                                    </td>
                                    <td class="text-sm">
                                        <div class="dropdown">
                                            <a href="#" class="btn bg-gradient-white dropdown-toggle "
                                                data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
                                                <li>
                                                    <a href="{{ '/admin/print/' . $item->id }}"
                                                        data-id="{{ $item->id }}" data-bs-toggle="tooltip"
                                                        class="badge badge-primary reprint-link dropdown-item py-1">Print</a>
                                                </li>
                                                <li>
                                                    <a href={{ '/admin/generate-pdf/' . $item->id }}
                                                        data-bs-toggle="tooltip"
                                                        class="badge badge-info dropdown-item py-1">Unduh</a>
                                                </li>
                                                <li>
                                                    <a href={{ '/admin/editsurat/' . $item->id }} data-bs-toggle="tooltip"
                                                        class="badge badge-success dropdown-item py-1">Edit</a>
                                                </li>
                                                <li>
                                                    <a href="javascript::void(0)"
                                                        class="badge badge-danger delete-surat dropdown-item py-1"
                                                        data-id="{{ $item->id }}">Hapus</a>
                                                </li>
                                                <li>
                                                    <a href={{ '/admin/importskbhk/' . $item->id }} data-bs-toggle="modal"
                                                        data-bs-target="#import"
                                                        class="badge badge-dark dropdown-item py-1">Unggah</a>
                                                </li>
                                                <li>
                                                    @if ($item->file_path)
                                                        <a href="#"class="badge badge-secondary dropdown-item"
                                                            data-bs-toggle="tooltip" target="_blank"
                                                            onClick="window.open('{{ url('upload/' . $item->file_path) }}', '_blank', 'fullscreen=yes'); return false;">Lihat
                                                            SKBHK</a>
                                                    @endif
                                                </li>
                                            </ul>
                                        </div>



                                        <div class="modal fade" id="import" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog mt-lg-10">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="ModalLabel">Upload SKBHK</h5>
                                                        <i class="fas fa-upload ms-3"></i>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ url('/admin/importskbhk/' . $item->id) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="file" class="form-label">Pilih file </label>
                                                                <input type="file" class="form-control" id="file"
                                                                    name="file" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" class="form-check-input"
                                                                        name="importCheck" id="importCheck" checked>
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
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{ asset('assets/js/argon-dashboard.min.js?v=2.0.5') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/datatables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menampilkan SweetAlert
            function showSweetAlert(icon, title, text) {
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                });
            }

            // Fungsi untuk menangani logika reprint
            function handleReprint(target) {
                const suratId = target.getAttribute('data-id');
                var reprintStatus = localStorage.getItem('reprintStatus') ? JSON.parse(localStorage.getItem(
                    'reprintStatus')) : {};

                // Jika suratId tidak ada dalam reprintStatus, atur statusnya menjadi 'Print'
                if (!reprintStatus.hasOwnProperty(suratId) || typeof reprintStatus[suratId] !== 'boolean') {
                    reprintStatus[suratId] = false;
                }

                // Perbarui teks tautan berdasarkan status saat ini
                target.textContent = reprintStatus[suratId] ? 'Reprint' : 'Print';

                // Jika belum pernah diklik, atur ke 'Reprint'
                if (!reprintStatus[suratId]) {
                    reprintStatus[suratId] = true;
                } else {
                    // Jika sudah pernah diklik, atur ke 'Print'
                    reprintStatus[suratId] = false;
                }

                // Simpan status yang diperbarui ke sessionStorage
                sessionStorage.setItem('reprintStatus', JSON.stringify(reprintStatus));

                // Alihkan ke halaman href setelah reprint
                window.location.href = target.getAttribute('href');
            }

            $(document).on('click', '.delete-surat', function() {
                const suratId = $(this).attr('data-id');

                Swal.fire({
                    title: 'Anda yakin ingin menghapus surat ini?',
                    text: 'Aksi ini tidak dapat dibatalkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/admin/hapussurat/${suratId}`;
                    }
                });

                if ($(target).hasClass('reprint-link')) {
                    event.preventDefault();
                    handleReprint(target);
                }
            })


            // Periksa status di sessionStorage ketika halaman dimuat ulang
            var allReprintLinks = document.querySelectorAll('.reprint-link');
            allReprintLinks.forEach(function(link) {
                const suratId = link.getAttribute('data-id');
                var reprintStatus = sessionStorage.getItem('reprintStatus') ? JSON.parse(sessionStorage
                    .getItem('reprintStatus')) : {};

                // Jika suratId tidak ada dalam reprintStatus, atur statusnya menjadi 'Print'
                if (!reprintStatus.hasOwnProperty(suratId) || typeof reprintStatus[suratId] !== 'boolean') {
                    reprintStatus[suratId] = false;
                }

                // Perbarui teks tautan berdasarkan status saat ini
                link.textContent = reprintStatus[suratId] ? 'Reprint' : 'Print';
            });
        });
    </script>


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

    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-surat');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const suratId = button.getAttribute('data-id');

                Swal.fire({
                    title: 'Anda yakin ingin menghapus surat ini?',
                    text: 'Aksi ini tidak dapat dibatalkan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/admin/hapussurat/${suratId}`;
                    }
                });
            });
        });
    });
</script> --}}

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.2'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        if (document.getElementById('products-list')) {
            const dataTableSearch = new simpleDatatables.DataTable("#products-list", {
                searchable: true,
                fixedHeight: false,
                perPage: 5,
                plugins: {
                    fixedHeader: true
                }
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
        }
    </script>


    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="../../../assets/js/argon-dashboard.min.js?v=2.0.5"></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endsection
