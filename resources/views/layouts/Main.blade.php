@include('layouts/Main/__head')

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  @include('layouts/Main/__header')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts/Main/__aside')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('layouts/Main/__pageTitle')

    <!-- Main content -->
    <section class="content">
      @yield('container')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 @include('layouts/Main/__footer')
</div>
<!-- ./wrapper -->

<!-- jQuery -->

@include("layouts/Main/__foot")