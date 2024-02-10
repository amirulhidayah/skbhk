@section ('title', 'Master Data Branch Franchise')
@section ('pages1', 'Master Data Branch Franchise')
@section ('pages2', 'Edit')
@extends('/layouts/master')
@section ('content')
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
        <form class="multisteps-form__form mb-1" action="{{url('admin/editbranchfranchise/'.$masterbranchfranchise->id)}}" method="POST">
            @method('PUT')      
            @csrf
          <!--single form panel-->
            <div class="card multisteps-form__panel p-4 border-radius-xl bg-white js-active" data-animation="FadeIn">
                <h5 class="font-weight-bolder">Edit Branch Franchise</h5>
              <div class="row pb-4">
                  <div class="col-4 col-sm-4 mt-10 mt-sm-0">
                    <label>PT/CV/Waralaba</label>
                    <input id="nama_pt" type="text" class="multisteps-form__input form-control @error('nama_pt') is-invalid @enderror"  name="nama_pt" value="{{ $masterbranchfranchise->nama_pt}}" required autocomplete="nama_pt" placeholder="Head Office" autofocus/>
                  </div>
                  <div class="col-8">
                      <label>Alamat</label>
                      <input id="alamat" type="text" class="multisteps-form__input form-control @error('alamat') is-invalid @enderror"  name="alamat" value="{{ $masterbranchfranchise->alamat}}"required autocomplete="alamat"  placeholder="Alfa Tower- Jl.Jalur Sutera Barat kav.9 Alam Sutera, Tanggerang 15143" autofocus/>
                    </div>
              </div>
              <div class="row">
                 <div class="col-4">
                  <label>no_telp</label>
                  <input id="no_telp" type="text" class="multisteps-form__input form-control @error('no_telp') is-invalid @enderror"  name="no_telp" value="{{ $masterbranchfranchise->no_telp}}" required autocomplete="no_telp"  placeholder="021-808 21 555" autofocus/>
                  </div>
                  <div class="col-4">
                    <label>no_fax</label>
                    <input id="no_fax" type="text" class="multisteps-form__input form-control @error('no_fax') is-invalid @enderror"  name="no_fax"value="{{ $masterbranchfranchise->no_fax }}" autocomplete="no_fax"  placeholder="021-808 21 556" autofocus/>
                  </div>
              </div>
              <div class="button-row d-flex mt-4">
                <a href="{{ '/admin/masterbranchfranchise' }}" class="btn bg-gradient-dark mb-0">Kembali</a>
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
