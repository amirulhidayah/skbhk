<!DOCTYPE html>
<html lang="{{str_replace("_",'-', app()->getLocale())}}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Meta -->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">

  <!-- Script -->
  <script src="{{asset('jqueryui/jquery-3.7.1.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


  <link rel="apple-touch-icon" sizes="96x96" href="{{asset('assets/img/logos/profil-alfa.png')}}"> 
  <link rel="icon" href="{{asset('assets/img/logos/profil-alfa.png')}}">
  <title>
    @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('assets/css/argon-dashboard.css?v=2.0.5')}}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-danger position-absolute w-100"></div>
  @include('layoutsuser.inc.user-sidebar')
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    @include('layoutsuser.inc.user-navbar')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
    @yield('content')
    @include('layoutsuser.inc.user-footer')
    </div>
  </main>
</div>
</body>
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/sweetalert.min.js')}}"></script>
<!-- Kanban scripts -->
<script src="{{asset('assets/js/plugins/dragula/dragula.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jkanban/jkanban.js')}}"></script>
<script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
<script async defer src="{{https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{asset('assets/js/argon-dashboard.min.js?v=2.0.5'))}"></script
</body>
</html>