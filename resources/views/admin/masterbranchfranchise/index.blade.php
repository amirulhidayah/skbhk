@section ('title', 'Master Data Branch Franchise')
@section ('pages1', 'Master Data')
@section ('pages2', 'Branch Franchise')
@extends('/layouts/master')
@section ('content')
<div class="col-12">
    <div class="card">
       <!-- Card header -->
       <div class="card-header pb-0">
          <div class="d-lg-flex">
            <div>
              <h5 class="mb-0">Data Branch Franchise</h5>
              <p class="text-sm mb-0">
                Informasi terkait Branch Reguler
              </p>
            </div>
            <div class="ms-auto my-auto mt-lg-0 mt-4">
              <div class="ms-auto my-auto">
                <a href={{url('admin/tambahbranchfranchise')}} class="btn bg-gradient-info btn-sm mb-0">+&nbsp; tambah</a>
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
                <th>PT/CV/Waralaba</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $nourut=1; ?>
                @foreach ($masterbranchfranchise ->reverse() as $item)
                <tr class="thead-light">
                  <td>{{$nourut++}}</td>
                  <td>{{$item->nama_pt}}</td>
                  <td class="text-sm">
                    <div class="row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="status_{{$item->id}}" name="status" value="1" {{$item->status ? 'checked' : ''}}>
                            <label class="form-check-label" for="status_{{$item->id}}">
                                {{$item->status ? 'Aktif' : 'Tidak Aktif'}}
                            </label>
                        </div>
                    </div>
                  </td>
                  <td class="text-sm">
                    <a href={{('/admin/editbranchfranchise/'.$item->id)}}  data-bs-toggle="tooltip" class="badge badge-success edit-surat">Edit</a> 
                    <a class="badge badge-danger delete-user" data-id="{{$item->id}}">Hapus</a>
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
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/datatables.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
      $('.form-check-input').on('change', function () {
          var itemId = $(this).attr('id').split('_')[1];
          var newStatus = $(this).prop('checked') ? 1 : 0;

          $.ajax({
    url: '/admin/update-status/' + itemId,
    method: 'POST',
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        status: newStatus
    },
    success: function (response) {
        console.log(response);
    },
    error: function (error) {
        console.error('Error:', error);
    }
});

      });
  });
</script>
<script>
    $(document).ready(function () {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        @elseif(session('error'))
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
<script>
  $(document).ready(function () {
      $('.form-check-input').on('change', function () {
          var itemId = $(this).attr('id').split('_')[1];
          var newStatus = $(this).prop('checked') ? 1 : 0;

          // Kirim permintaan Ajax ke server
          $.ajax({
              url: '/admin/update-status/' + itemId,
              method: 'POST',
              data: {
                  _token: '{{ csrf_token() }}',
                  status: newStatus
              },
              success: function (response) {
                  console.log(response);
              },
              error: function (error) {
                  console.error('Error:', error);
              }
          });
      });
  });
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
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const deleteButtons = document.querySelectorAll('.delete-user');

      deleteButtons.forEach(button => {
          button.addEventListener('click', function () {
              const masterbranchregulerId = button.getAttribute('data-id');

              Swal.fire({
                  title: 'Anda yakin ingin menghapus data ini?',
                  text: 'Aksi ini tidak dapat dibatalkan!',
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ya, Hapus!'
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Redirect to the delete route with the data ID
                      window.location.href = `/admin/hapusbranchfranchise/${masterbranchregulerId}`;
                  }
              });
          });
      });
  });
</script>

@endsection

