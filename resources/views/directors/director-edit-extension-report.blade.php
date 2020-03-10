@extends('layouts.layout-master')
@section('title',"Edit - {$director_extension_report->title}")
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Extension</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
			<a href="{{ route('director-extension-reports.index', $director_extension_report->card_id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        </div>
	</div>
	<div class="row">
		<div class=" col-md-7">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">
						<i class="fas fa-edit"></i>
						{{ $director_extension_report->title }}
					</h5>
				</div>
				<div class="card-body">
					{{-- {{ route('extension-report.update', $user_extension_report->id) }} --}}
					<form action="{{ route('director-extension-reports.update',$director_extension_report->id) }}" method="POST" role="form">
						<div class="form-group">
							@csrf
							<input name="_method" type="hidden" value="PUT">
							<label>Title *</label>
							<input type="text" id="name" class="form-control" name="title" value="{{ $director_extension_report->title }}" required>
						</div>
						<div class="form-group">
							<label>Short description</label>
							<textarea id="shortDescription" class="form-control" name="short_description" required>{{ $director_extension_report->short_description }}</textarea>	
						</div>			
						<div class="form-group">
							<label>Project cost *</label>
							<input type="text" id="currency-field" pattern="^\₱\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" class="form-control" name="project_cost" value="{{ $director_extension_report->project_cost }}" required>
						</div>
						<div class="form-group">
							<label>Funding source *</label>
							<input type="text" id="fundingSource" class="form-control" name="funding_source" value="{{ $director_extension_report->funding_source }}" required>
						</div>			
						<div class="form-group">
							<label>Agency *</label>
							<input type="text" id="agency" class="form-control" name="agency" value="{{ $director_extension_report->agency }}" required>
						</div>
						<div class="form-group">
							<label>SDG/s addressed</label>
							<input type="text" id="sdgsAddressed" class="form-control" name="sdgs_addressed" value="{{ $director_extension_report->sdgs_addressed }}" required>
						</div>
						<div class="form-group">
							<label>Beneficiaries and Impact</label>
							<textarea class="form-control" name="beneficiaries" required>{{ $director_extension_report->beneficiaries }}</textarea>	
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
						<a href="{{ $director_extension_report->url }}" class="text-danger">{{ $director_extension_report->file }}</a>
					</h6>
				</div>
				<div class="card-body">
					<form action="{{ route('director-extension-reports.update',$director_extension_report->id) }}" method="POST" enctype="multipart/form-data">
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
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h5 class="m-0 font-weight-bold text-primary">
						<i class="fas fa-edit"></i>
						Photos
					</h5>
				</div>
				<div class="card-body">
					<div class="row text-center text-lg-left">
						@foreach($director_extension_report->extensionReportPhotos as $photo)
							<div class="col-lg-3 col-md-4 col-6">
								<a href="javascript:void(0)" class="btn-delete" title="Delete" data-id="{{ $photo->id }}" data-textval="Photo">
									<i class="fas fa-trash fa-sm fa-fw text-gray-800"></i>
									Remove
								</a>
								<form id="delete-form{{ $photo->id }}" action="{{ route('director-extension-reports-photos.destroy', $photo->id) }}" method="POST">
									@csrf
									<input name="_method" type="hidden" value="DELETE">
								</form>
								<a href="{{ $director_extension_report->url }}" target="_blank" class="d-block mb-4 h-100">
									<img class="img-fluid img-thumbnail" src="{{ $director_extension_report->url }}">
								</a>
							</div>
						@endforeach
					</div>
					{{-- {{ route('user-research-reports.update', $user_research_report->id) }} --}}
					<form action="{{ route('director-extension-reports.update',$director_extension_report->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						<input name="_method" type="hidden" value="PUT">
						<div class="form-group">
							<label>Add Photos</label>
							<input type="file" class="defaultdropify" name="photos[]" data-allowed-file-extensions="JPEG jpg png" multiple required>
						</div>
						<button type="submit" class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-plus"></i>
							</span>
							<span class="text">Add</span>
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection