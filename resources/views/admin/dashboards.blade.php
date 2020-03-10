@extends('layouts.layout-master')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	{{-- 	<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
	</div>
 <!-- Content Row -->
  <div class="row">
      <!-- Research Card -->
      <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <a href="{{ route('admin-research.index') }}">
            <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Research</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
              </div>
            </div>
            </a>
        </div>
      </div>
      <!-- Research Card -->
      <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
            <a href="{{ route('admin-extension.index') }}">
              <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Extension</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
              </div>
            </a>
          </div>
        </div>
      </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Research Reports Progress</h6>
        </div>
        <div class="card-body">
          <table class="table table-hover table-striped" id="research-progress-status-datatables">
            <thead>
              <th>Type</th>
              <th>Fiscal year</th>
              <th>Status</th>
              <th>Progress</th>
            </thead>
          </table>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Extension Reports Progress</h6>
        </div>
        <div class="card-body">
          <table class="table table-hover table-striped" id="extension-progress-status-datatables">
            <thead>
              <th>Type</th>
              <th>Fiscal year</th>
              <th>Status</th>
              <th>Progress</th>
            </thead>
          </table>       
        </div>
      </div>
    </div>
  </div>
  @section('ajax-request')
    <script type="text/javascript">
      $(document).ready(function() {
          $('#research-progress-status-datatables').DataTable({
            "columnDefs": [{ 
              "orderable": false, "targets": [0,2,3]
            }],
            "bFilter": false,
            "bInfo": false,
            "bLengthChange": false,
            "processing": false,
            "serverSide": false,
            "ajax":{
              "url": "{{ route('admin.dashboard.research.progress.status') }}",
              "type": "GET"
            },
            "columns": [
            { "data": "card_name" },
            { "data": "fiscal_year" },
            { "data": "status" },
            { "data": "progress" },
            ],
            "drawCallback": function(settings){
            }
          });

          $('#extension-progress-status-datatables').DataTable({
            "columnDefs": [{ 
              "orderable": false, "targets": [0,2,3]
            }],
            "bFilter": false,
            "bInfo": false,
            "bLengthChange": false,
            "processing": false,
            "serverSide": false,
            "ajax":{
              "url": "{{ route('admin.dashboard.extension.progress.status') }}",
              "type": "GET"
            },
            "columns": [
            { "data": "card_name" },
            { "data": "fiscal_year" },
            { "data": "status" },
            { "data": "progress" },
            ],
            "drawCallback": function(settings){
            }
          });
      });
    </script>
  @endsection
@endsection