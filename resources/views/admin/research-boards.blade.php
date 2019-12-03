@extends('layouts.layout-master')
@section('title','Research')
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Research</h1>
		@if(Auth::user()->hasRole('role_admin'))
			<a href="#modal-id" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal"><i class="fas fa-plus fa-sm text-white-50"></i> Create Card</a>
		@endif
	</div>
	<!-- Content Row -->
	<div class="row">
		@foreach($researchCards as $card)
		<div class="col-lg-6">
			<!-- Dropdown Card Example -->
			<div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                	<h6 class="m-0 font-weight-bold text-primary">
                		{{ $card->card_name }} {{ $card->fiscal_year }}
                	</h6>
                  	<div class="dropdown no-arrow">
                    	<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      		<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    	</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
							<div class="dropdown-header">Options:</div>
							@include('includes.crud-card-btn')
						</div>
                  	</div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                	{{-- <blockquote class="m-t-10">{{ $card->description }}</blockquote> --}}
                	<div class="profiletimeline">
                		<div class="sl-item">
                			<div class="sl-left"> <img src="/assets/images/users/4.jpg" alt="user" class="img-circle"> </div>
                			<div class="sl-right">
                				<div>
                					<a href="#" class="link">{{ $card->users->name }}</a>
                					<span class="sl-date">5 minutes ago</span>
                					<blockquote class="m-t-10">
                						{{ $card->message }}
                					</blockquote>
                				</div>
                			</div>
                		</div>
                	</div>
                	<hr>
                	<div class="profiletimeline">
                		@foreach($card->reports as $report)
	                		<div class="sl-item">
	                			<div class="sl-left"> <img src="../assets/images/users/3.jpg" alt="user" class="img-circle"> </div>
	                			<div class="sl-right">
	                				<div>
	                					<a href="#" class="link">{{ $report->users->name }}</a> 
	                					<span class="sl-date">
	                						5 minutes ago 
	                					</span>	
	                					@if(Auth::user()->hasRole('role_user'))                					
		                					<span class="dropdown no-arrow" style="float:right;">
						                    	<a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						                      		<i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
						                    	</a>
												<div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
													<div class="dropdown-header">Options:</div>
													<a class="dropdown-item edit-report-name" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $report->id }}" data-backdrop="static">
														<i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
														Edit report's name
													</a>
													<a class="dropdown-item edit-report-file" href="javascript:void(0)" data-toggle="modal" data-target="#modal-id-crud" data-id="{{ $report->id }}" data-backdrop="static">
														<i class="fas fa-edit fa-sm fa-fw text-gray-400"></i>
														Change file
													</a>
												</div>
		                					</span>
	                					@endif
	                					<p class="m-t-10">
	                						{{ $report->name }}
	                					</p>
	                				</div>
	                				<div class="like-comm m-t-20"> 
	                					<i class="fas fa-file-excel fa-sm text-gray-80"></i>
	                					<a href="javascript:void(0)" class="link m-r-10">{{ $report->file }}</a>
	                				</div>
	                			</div>
	                		</div>
							<hr>
                		@endforeach
                	</div>
                </div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Create Card</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

				</div>
				<div class="modal-body">
					<form action="{{ action('ResearchCardsController@store') }}" method="POST" role="form">					
						<div class="form-group">
							@csrf
							<label for="fiscalYear">Fiscal-Year</label>
							<select id="fiscalYear" class="form-control" name="fiscal_year" required>
								@for($i=date('Y'); $i >= 2000; $i--)
									<option>FY {{ $i }}</option>
								@endfor
							</select>
						</div>
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" id="name" class="form-control" name="card_name" required>
						</div>
						<div class="form-group">
							<label for="description">Description</label>
							<textarea id="description" class="form-control" name="description"></textarea>
						</div>
						<div class="form-group">
							<label for="message">Message</label>
							<textarea id="message" class="form-control" name="message"></textarea>
						</div>						
					
						<button type="submit" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-plus"></i>
							</span>
							<span class="text">Create</span>
						</button>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	@include('includes.modal')
	@section('ajax-request')
		<script type="text/javascript" src="/js/custom/edit-card-ajax.js"></script>
		<script type="text/javascript" src="/js/custom/edit-message-ajax.js"></script>
		<script type="text/javascript" src="/js/custom/submit-report-ajax.js"></script>
		<script type="text/javascript" src="/js/custom/edit-report-name-ajax.js"></script>
		<script type="text/javascript" src="/js/custom/edit-report-file-ajax.js"></script>
		<script src="/assets/plugins/sweetalert/jquery.sweet-alert.custom.js"></script>
	@endsection
@endsection