@extends('layouts.layout-master')
@section('title','Research')
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Research</h1>
		<button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h5 class="m-0 font-weight-bold text-primary">
				{{ $card->card_name." "."FY ".$card->fiscal_year }}
				@if($card->is_lock)
					<i class="fas fa-lock fa-md fa-fw" style="color: #e74a3b;"></i>
				@else
					<i class="fas fa-unlock fa-md fa-fw" style="color: #36b9cc;"></i>
				@endif
			</h5>
			<h6 class="m-0 font-weight-bold text-primary">
				Description: {{ $card->description }}
			</h6>
			<h6 class="m-0 font-weight-bold text-primary">
				Deadline: {{ $card->deadline->format('F d,Y') }}
			</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('director-research-reports.store') }}" method="POST" enctype="multipart/form-data" role="form">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							@csrf
							<input type="hidden" name="cardid" value="{{ $card->id }}">
							<label>Title *</label>
							<input type="text" id="name" class="form-control" name="title" value="{{ old('title') }}" required>
						</div>
						<div class="form-group">
							<label>Short description</label>
							<textarea id="shortDescription" class="form-control" name="short_description" required>{{ old('short_description') }}</textarea>	
						</div>			
						<div class="form-group">
							<label>Project cost *</label>
							<input type="text" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency"  class="form-control" name="project_cost" value="{{ old('project_cost') }}" required>
						</div>
						<div class="form-group">
							<label>Funding source *</label>
							<input type="text" id="fundingSource" class="form-control" name="funding_source" value="{{ old('funding_source') }}" required>
						</div>			
						<div class="form-group">
							<label>Agency *</label>
							<input type="text" id="agency" class="form-control" name="agency" value="{{ old('agency') }}" required>
						</div>
						<div class="form-group">
							<label>SDG/s addressed</label>
							<input type="text" id="sdgsAddressed" class="form-control" name="sdgs_addressed" value="{{ old('sdgs_addressed') }}" required>
						</div>
						<div class="form-group">
							<label>Beneficiaries and Impact</label>
							<textarea class="form-control" name="beneficiaries" required>{{ old('beneficiaries') }}</textarea>	
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Attach file</label>
							<input type="file" id="input-file-now" class="defaultdropify" name="file" data-allowed-file-extensions="docs docx xls xlsx pdf pptx ppt" required>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary btn-icon-split">
					<span class="icon text-white-50">
						<i class="fas fa-upload"></i>
					</span>
					<span class="text">Submit</span>
				</button>
			</form>
		</div>
	</div>
@endsection
