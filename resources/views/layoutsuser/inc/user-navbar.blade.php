<nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky " id="navbarBlur"
    data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="text-white" href="javascript:;">
                        <i class="ni ni-box-2"></i>
                    </a>
                </li>
                <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                        href="javascript:;">@yield('pages1')</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('pages2')</li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-white">@yield('pages2')</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
              <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
                <div></div>
                <ul class="navbar-nav  justify-content-end">
                    <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                          <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                          </div>
                        </a>
                      </li>
                    <li class="nav-item dropdown align-items-center" >
                        <a id="navbarDropdown" class="nav-link dropdown-toggle font-weight-bolder mb-0 text-white"
                            href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="fas fa-user"></i>{{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('/editprofile')}}">
                            {{ __('Edit Profil') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


 <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
 <script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.5')}}"></script>
 
