@extends('layouts.layout-master')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
	</div>
	<!-- Content Row -->
	<div class="row">
      <!-- Research Card -->
      <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
          <div class="card-body">
            <a href="#">
              {{-- {{ action('ResearchBoardsController@index') }} --}}
              <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">Research</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalnumbersOfActiveReportsForResearch }} report/s for submission</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalnumbersOfLockedReportsForResearch }} locked reports for submission</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      <!-- Research Card -->
      <div class="col-xl-6 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
          <div class="card-body">
             <a href="#"> 
               {{-- {{ action('ExtensionBoardsController@index') }} --}}
              <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Extension</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalnumbersOfActiveReportsForExtension }} report/s for submission</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalnumbersOfLockedReportsForExtension }} locked report/s for submission</div>
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
@endsection