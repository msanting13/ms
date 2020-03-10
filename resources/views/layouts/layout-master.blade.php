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
  <title>WBREMS - @yield('title')</title>
  <!-- Custom fonts for this template-->
  <link rel="icon" href="/mag/img/67794854_2178648335729029_448519625085288448_n.png">
  <link href="/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="/sb-admin/css/sb-admin-2.css" rel="stylesheet">
  <link href="/sb-admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="/sb-admin/vendor/datatables/buttons.dataTables.css" rel="stylesheet">
  {{-- <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet"> --}}
  <link href="/assets/plugins/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
  <!--Sweet Alert-->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha256-zuyRv+YsWwh1XR5tsrZ7VCfGqUmmPmqBjIvJgQWoSDo=" crossorigin="anonymous" /> -->
  <link href="/assets/plugins/sweetalert/sweetalert.min.css" rel="stylesheet" type="text/css">
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
    @elseif(Auth::user()->hasRole('role_director'))
      @include('includes.director-sidebar-navbar')
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
            <span>Copyright &copy; SDSSU WBREMS 2019</span>
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
  {{-- @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]) --}}
  <!-- <script src="/assets/plugins/sweetalert/sweetalert.min.js"></script> -->
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script> -->
  <script src="/assets/plugins/sweetalert/sweetalert.all.min.js"></script>
  @include('sweetalert::alert')
  <script src="/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
  <script src="/assets/plugins/dropify/dist/js/dropify.min.js"></script>
  <!--Ckeditor-->
  <script src="/assets/plugins/ckeditor/ckeditor.js"></script>
  <script src="/assets/plugins/ckeditor/custom/config.js"></script>
  
  @yield('ajax-request')
  <!-- Page level plugins -->
  <script src="/sb-admin/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="/sb-admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="/sb-admin/vendor/datatables/datatables.net-buttons/js/dataTables.buttons.js"></script>
  <script src="/sb-admin/vendor/datatables/datatables.net-buttons/js/buttons.colVis.min.js"></script>
  <script src="/sb-admin/vendor/datatables/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.20/dataRender/ellipsis.js"></script>
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
  <script>
    function initDateTimePicker() 
    {
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
    }
    initDateTimePicker();
  </script>
  <!--js-switch-->
  <script>
    function initJSwitch(selector)
    {
        if ($(".js-switch")[0]) {
            var elems = Array.prototype.slice.call(document.querySelectorAll(selector));
            elems.forEach(function (html) {
                var switchery = new Switchery(html, {
                    color: '#26B99A'
                });
            });
        }
    }
    initJSwitch('.all-day');
  </script>
  <script src="/assets/plugins/bootstrap-switch/custom-switch.js"></script>
  <script src="/assets/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
  <script type="text/javascript">
    function initbootstrapSwitch(){
      $(".bt-switch input[type='checkbox']").bootstrapSwitch();
    }
  </script>
  <script type="text/javascript">
   function postUpostSwitcher(){
      var stopchange = false;

      $('.post-unpost-switch').on('switchChange.bootstrapSwitch', function (e, state) {

          let message;
          let obj = $(this);
          let id = $(this).data('id');
          let title = $(this).data("textval");
          let currentState = $(this).val();

          if(currentState == "off"){
              message = "Post";
          }else{
              message = "Unpost";
          }

          if(stopchange === false)
          {
              swal.fire({
                  title: 'Are you sure you want to '+message+'?',
                  text: title,
                  icon: 'warning',
                  input: 'password',
                  inputPlaceholder: 'Enter your password to continue',
                  showCancelButton: true,
                  confirmButtonText: 'Yes '+message+' it!',
                  allowOutsideClick: false,
                  inputValidator: (value) => {
                      if (!value) {
                        return 'You need to write something!'
                    }
                }
              })
              .then((result) => {
                  if (result.value) {
                      let dataString = 'password='+result.value + '&id='+id;
                      $.ajax({
                          url:'@yield('publisher')'+id,
                          type:"GET",
                          dataType:"json",
                          data: dataString,
                          success:function(data){
                              if (data.done == true) {
                                  Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                }).then((isConfirm) => {
                                  if (isConfirm) {
                                    if(data.message == "Posted"){
                                      obj.attr("value","on")
                                    }else{
                                      obj.attr("value","off")
                                    }
                                  } 
                                });

                              }
                              if (data.error == false) {
                                  Swal.fire({
                                    icon: 'warning',
                                    title: data.message,
                                }).then((isConfirm) => {
                                  if (isConfirm) {
                                    if(stopchange === false){
                                      stopchange = true;
                                      obj.bootstrapSwitch('toggleState');
                                      stopchange = false;
                                    }
                                  } 
                          });
                              }
                          },
                          error: function() {
                              Swal.fire({
                                  title: "Something went wrong!",
                                  icon: "warning",
                              });
                          }
                      });

                  }else if(result.dismiss == 'cancel'){
                      if(stopchange === false){
                          stopchange = true;
                          obj.bootstrapSwitch('toggleState');
                          stopchange = false;
                      }
                  }
              });
          }
      });
   }
  </script>
  <script>
  function goBack() {
    window.history.back();
  }
  </script>
  <script>
var $dOut = $('#date'),
    $hOut = $('#hours'),
    $mOut = $('#minutes'),
    $sOut = $('#seconds'),
    $ampmOut = $('#ampm');
var months = [
  'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'
];

var days = [
  'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
];

function update(){
  var date = new Date();
  
  var ampm = date.getHours() < 12
             ? 'AM'
             : 'PM';
  
  var hours = date.getHours() == 0
              ? 12
              : date.getHours() > 12
                ? date.getHours() - 12
                : date.getHours();
  
  var minutes = date.getMinutes() < 10 
                ? '0' + date.getMinutes() 
                : date.getMinutes();
  
  var seconds = date.getSeconds() < 10 
                ? '0' + date.getSeconds() 
                : date.getSeconds();
  
  var dayOfWeek = days[date.getDay()];
  var month = months[date.getMonth()];
  var day = date.getDate();
  var year = date.getFullYear();
  
  var dateString = dayOfWeek + ', ' + month + ' ' + day + ', ' + year;
  
  $dOut.text(dateString);
  $hOut.text(hours+':');
  $mOut.text(minutes+':');
  $sOut.text(seconds);
  $ampmOut.text(ampm);
} 

update();
window.setInterval(update, 1000);

function currencyFormatter(){
       // Jquery Dependency
        $("input[data-type='currency']").on({
            keyup: function() {
              formatCurrency($(this));
            },
            blur: function() { 
              formatCurrency($(this), "blur");
            }
        });

        function formatNumber(n) {
          // format number 1000000 to 1,234,567
          return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
          // appends $ to value, validates decimal side
          // and puts cursor back in right position.
          
          // get input value
          var input_val = input.val();
          
          // don't validate empty input
          if (input_val === "") { return; }
          
          // original length
          var original_len = input_val.length;

          // initial caret position 
          var caret_pos = input.prop("selectionStart");
            
          // check for decimal
          if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);
            
            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
              right_side += "00";
            }
            
            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = "₱" + left_side + "." + right_side;

          } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = "₱" + input_val;
            
            // final formatting
            if (blur === "blur") {
              input_val += ".00";
            }
          }
          
          // send updated string to input
          input.val(input_val);

          // put caret back in the right position
          var updated_len = input_val.length;
          caret_pos = updated_len - original_len + caret_pos;
          input[0].setSelectionRange(caret_pos, caret_pos);
        }
  } 
  currencyFormatter();
  deleteFunction();
  </script>
	<script type="text/javascript">
		$(document).ready(function() {
		  $(".defaultdropify").dropify();
		});
	</script>
</body>
</html>
