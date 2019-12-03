<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin 2 - @yield('title')</title>
  <!-- Custom fonts for this template-->
  <link href="/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="/sb-admin/css/sb-admin-2.css" rel="stylesheet">
  <link href="/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!--Sweet Alert-->
  <link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
  <link href="/assets/plugins/dropify/dist/css/dropify.min.css" rel="stylesheet">
  <link href="/sb-admin/css/custom.css" rel="stylesheet">
  <!-- Switchery -->
  <link href="/assets/plugins/switchery/dist/switchery.min.css" rel="stylesheet">
   <!-- DateRangePicker -->
  <link href="/assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet">
  <link href="/assets/plugins/daterangepicker/datetimepicker.css" rel="stylesheet">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    @if(Auth::user()->hasRole('role_admin'))
      @include('includes.admin-sidebar-navbar')
    @else
      @include('includes.user-sidebar-navbar')
    @endif
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        @include('includes.topbar-navbar')
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          @yield('content')
          <!--f-->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Logout Modal-->
  @include('includes.logout-modal')
  <!-- Bootstrap core JavaScript-->
  <script src="/sb-admin/vendor/jquery/jquery.min.js"></script>
  <script src="/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="/sb-admin/js/sb-admin-2.min.js"></script>
  <script src="/sb-admin/js/custom.js"></script>
    <!-- DateRangePikcer -->
  <script src="/assets/plugins/daterangepicker/moment.min.js"></script>
  <script src="/assets/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="/assets/plugins/daterangepicker/datetimepicker.min.js"></script>
  <!-- Switchery -->
  <script src="/assets/plugins/switchery/dist/switchery.min.js"></script>
  <!--sweetalert kit -->
  <script src="/assets/plugins/sweetalert/sweetalert.min.js"></script>
  <script src="/assets/plugins/dropify/dist/js/dropify.min.js"></script>
  <!--Ckeditor-->
  <script src="/assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="/assets/plugins/ckeditor/custom/config.js"></script>
  
  @yield('ajax-request')
  <!-- Page level plugins -->
  <script src="/sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="/sb-admin/js/demo/datatables-demo.js"></script>
  <script src="/assets/plugins/daterangepicker/custom.min.js"></script>
  <script>
    $('#startDateTimePicker,#endDateTimePicker').datetimepicker({
        format: 'MM/DD/YYYY',
    });
    $('#startTimeDateTimePicker,#endtimeDateTimePicker').datetimepicker({
        format: 'hh:mm A'
    });
    $('#endDateTimePicker').datetimepicker({
        useCurrent: false,
    });
    $("#startDateTimePicker").on("dp.change", function(e) {
        $('#endDateTimePicker').data("DateTimePicker").minDate(e.date);
    });
    $("#endDateTimePicker").on("dp.change", function(e) {
        $('#startDateTimePicker').data("DateTimePicker").maxDate(e.date);
    });
  </script>
</body>
</html>
