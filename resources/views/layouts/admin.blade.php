<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'ClubFoot') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

{{-- 1. Top Menu - Navbar --}}
@include('layouts.navbar')

{{-- 2. Left Menu - Sidebar --}}
@include('layouts.sidebar')

{{-- 3. Main Content - Content --}}

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
  </div>

{{-- 4. Right Menu - Rightbar --}}
@include('layouts.rightbar')

{{-- 5. Bottom Menu - Footer --}}
@include('layouts.footer')


</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script type="text/javascript">
  if (typeof jQuery == "undefined")
  {
    document.write(unescape("%3Cscript type='text/javascript' src='{{ asset('adminlte/plugins/jquery/jquery.min.js') }}'%3E%3C/script%3E"));
  }
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
