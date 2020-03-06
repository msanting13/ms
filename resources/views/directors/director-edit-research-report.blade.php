@extends('layouts.layout-master')
@section('title',"Edit - {$director_research_report->title}")
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Rsearch</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('director-research-reports.index', $director_research_report->card_id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
	</div>
	<div class="row">
		<div class=" col-md-7">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">
						<i class="fas fa-edit"></i>
						{{ $director_research_report->title }}
					</h5>
				</div>
				<div class="card-body">
					<form action="{{ route('director-research-reports.update', $director_research_report->id) }}" method="POST" role="form">
						<div class="form-group">
							@csrf
							<input name="_method" type="hidden" value="PUT">
							<label>Title *</label>
							<input type="text" id="name" class="form-control" name="title" value="{{ $director_research_report->title }}" required>
						</div>
						<div class="form-group">
							<label>Short description</label>
							<textarea id="shortDescription" class="form-control" name="short_description" required>{{ $director_research_report->short_description }}</textarea>	
						</div>			
						<div class="form-group">
							<label>Project cost *</label>
							<input type="text" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="project_cost" value="{{ $director_research_report->project_cost }}" required>
						</div>
						<div class="form-group">
							<label>Funding source *</label>
							<input type="text" id="fundingSource" class="form-control" name="funding_source" value="{{ $director_research_report->funding_source }}" required>
						</div>			
						<div class="form-group">
							<label>Agency *</label>
							<input type="text" id="agency" class="form-control" name="agency" value="{{ $director_research_report->agency }}" required>
						</div>
						<div class="form-group">
							<label>SDG/s addressed</label>
							<input type="text" id="sdgsAddressed" class="form-control" name="sdgs_addressed" value="{{ $director_research_report->sdgs_addressed }}" required>
						</div>
						<div class="form-group">
							<label>Beneficiaries and Impact</label>
							<textarea class="form-control" name="beneficiaries" required>{{ $director_research_report->beneficiaries }}</textarea>	
						</div>
						<button type="submit" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-edit"></i>
							</span>
							<span class="text">Update</span>
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class=" col-md-5">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">
						<i class="fas fa-edit"></i>
						Attachment
					</h5>
					<h6 class="m-0 font-weight-bold text-danger">
						<i class="fas fa-file"></i>
						<a href="{{ $director_research_report->url }}" class="text-danger">{{ $director_research_report->file }}</a>
					</h6>
				</div>
				<div class="card-body">
					<form action="{{ route('director-research-reports.update', $director_research_report->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input name="_method" type="hidden" value="PUT">
						<div class="form-group">
							<label>Attach file</label>
							<input type="file" id="input-file-now" class="defaultdropify" name="file" data-allowed-file-extensions="docs docx xls xlsx pdf pptx ppt" required>
						</div>
						<button type="submit" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-edit"></i>
							</span>
							<span class="text">Update</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection
