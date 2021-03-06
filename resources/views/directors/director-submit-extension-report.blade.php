@extends('layouts.layout-master')
@section('title',"Extension - Submit Report for {$card->card_name} FY {$card->fiscal_year}")
@section('statusResearch','active')
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Extension</h1>
		<button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
	</div>
	<hr>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">
				{{ ucfirst($card->type)."/".$card->card_name." "."FY ".$card->fiscal_year }} Form
			</h6>
		</div>
		<div class="card-body">
			<form action="{{ route('director-extension-reports.store') }}" method="POST" enctype="multipart/form-data" role="form">
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
							<input type="text" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="project_cost" value="{{ old('project_cost') }}" required>
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
							<input type="file" class="defaultdropify" name="file" data-allowed-file-extensions="jpg docs docx xls xlsx pdf pptx ppt" required>
						</div>
						<div class="form-group">
							<label>Photos</label>
							<input type="file" id="input-file-now" class="defaultdropify" name="photos[]" data-allowed-file-extensions="JPEG jpg png" multiple required>
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


