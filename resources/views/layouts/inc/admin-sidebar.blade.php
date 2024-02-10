<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
  <!-- Konten Sidebar -->
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-3">
        <img src="{{asset('assets/img/logos/logo-alfa.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">SKBHK</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a  href="{{ url('admin/dashboard') }}"  class="nav-link {{ Request::is ('admin/dashboard') ? 'active':''  }}"  role="button" aria-expanded="false" >
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-shop text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboards</span>
          </a>
        </li>
        <li class="nav-item">
          <a  href="{{ url('admin/infosurat') }}"  class="nav-link {{ Request::is ('admin/infosurat') ? 'active':''  }}"  role="button" aria-expanded="false" >
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-ungroup text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1" >Surat</span>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#masterdata" class="nav-link {{Request::is('admin/masteruser') || Request::is('admin/masterkaryawan') || Request::is('admin/masterbranchreguler')|| Request::is('admin/masterbranchfranchise')|| Request::is('admin/mastertemplate')|| Request::is('admin/mastertoko')? 'collapse active':'collapsed'}} " aria-controls="applicationsExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-ui-04 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Master Data</span>
          </a>
          <div class="collapse {{Request::is('admin/masteruser') ||  Request::is('admin/masterkaryawan') || Request::is('admin/masterbranchreguler')|| Request::is('admin/masterbranchfranchise') ||  Request::is('admin/masterttd')  || Request::is('admin/mastertoko') ? 'show':'collapsed'}} " id="masterdata">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a  href="{{ url('/admin/masteruser') }}"  class="nav-link {{ Request::is('admin/masteruser') || Request::is('admin/edituser/*')? 'active':''  }}" role="button" aria-expanded="false">
                  <span class="sidenav-mini-icon"> K </span>
                  <span class="sidenav-normal"> Data User </span>
                </a>
              </li>
              <li class="nav-item ">
                <a  href="{{ url('/admin/masterkaryawan') }}"  class="nav-link {{ Request::is('admin/masterkaryawan') ? 'active':''  }}">
                  <span class="sidenav-mini-icon"> W </span>
                  <span class="sidenav-normal"> Data Karyawan </span>
                </a>
              </li>
              <li class="nav-item ">
                <a  href="{{ url('/admin/masterbranchreguler') }}"  class="nav-link {{ Request::is('admin/masterbranchreguler') || Request::is('admin/tambahbranchreguler/') || Request::is('admin/editbranchreguler/*') ? 'active':''  }}" role="button" aria-expanded="false">
                  <span class="sidenav-mini-icon"> K </span>
                  <span class="sidenav-normal"> Data Branch Reguler </span>
                </a>
              </li>
              <li class="nav-item ">
                <a  href="{{ url('/admin/masterbranchfranchise') }}"  class="nav-link {{ Request::is('admin/masterbranchfranchise') || Request::is('/editbranchfranchise/{masterbranchfranchise_id}') || Request::is('/tambahbranchfranchise') ? 'active':''  }}" role="button" aria-expanded="false">
                  <span class="sidenav-mini-icon"> K </span>
                  <span class="sidenav-normal"> Data Branch Franchise</span>
                </a>
              </li>
              <li class="nav-item ">
                <a  href="{{ url('admin/mastertoko') }}"  class="nav-link {{ Request::is('admin/mastertoko') ? 'active':''  }}" role="button" aria-expanded="false">
                  <span class="sidenav-mini-icon"> K </span>
                  <span class="sidenav-normal"> Data Toko Franchise</span>
                </a>
              </li>
              <li class="nav-item ">
                <a  href="{{ url('/admin/masterttd') }}"  class="nav-link {{ Request::is('admin/masterttd') || Request::is('admin/tambahttd/*') || Request::is('admin/editttd/*') ? 'active':''  }}" role="button" aria-expanded="false">
                  <span class="sidenav-mini-icon"> K </span>
                  <span class="sidenav-normal"> Data TTD</span>
                </a>
              </li>
             
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </aside>
  