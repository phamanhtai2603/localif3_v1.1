<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <base href="{{asset('')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Custom fonts for this template-->
  <link href="admin_page_asset/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin_page_asset/css/sb-admin-2.min.css" rel="stylesheet">
  @yield('css')
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    @include('admin.layouts.menu')
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('admin.layouts.header')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        @yield('content')
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      @include('admin.layouts.footer')
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  

  

  <!-- Bootstrap core JavaScript-->
  <script src="admin_page_asset/vendor/jquery/jquery.min.js"></script>
  <script src="admin_page_asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin_page_asset/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin_page_asset/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="admin_page_asset/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="admin_page_asset/js/demo/chart-area-demo.js"></script>
  <script src="admin_page_asset/js/demo/chart-pie-demo.js"></script>

</body>

</html>
