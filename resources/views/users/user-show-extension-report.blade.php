@extends('layouts.layout-master')
@section('title',"Extension - {$user_extension_report->title}")
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Extension</h1>
		<button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <a href="{{ route('user-submitted-extension-report-details.export-pdf',encrypt($user_extension_report->id)) }}" class="btn btn-info btn-sm" target="_blank" style="float:right;">
                <i class="fas fa-print"></i>
                Print
            </a>
			<h5 class="m-0 font-weight-bold text-primary">
                Details
			</h5>
		</div>
		<div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Project cost</th>
                        <th>Funding source</th>
                        <th>Agency</th>
                        <th>SDG's addressed</th>
                        <th>Beneficiaries</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">{{ $user_extension_report->title }}</td>
                        <td>{{ $user_extension_report->short_description }}</td>
                        <td>{{ $user_extension_report->project_cost }}</td>
                        <td>{{ $user_extension_report->funding_source }}</td>
                        <td>{{ $user_extension_report->agency }}</td>
                        <td>{{ $user_extension_report->sdgs_addressed }}</td>
                        <td>{{ $user_extension_report->beneficiaries }}</td>
                    </tr>
                </tbody>
            </table>
            <label>File: <a href="{{ $user_extension_report->url }}">{{ $user_extension_report->file }}</a></label>
        

                <hr class="mt-2 mb-5">
                <h5>Photos</h5>
                <div class="row text-center text-lg-left">
                  @foreach($user_extension_report->extensionReportPhotos as $photo)
                      <div class="col-lg-3 col-md-4 col-6">
                        <a href="{{ $photo->url }}" target="_blank" class="d-block mb-4 h-100">
                              <img class="img-fluid img-thumbnail" src="{{ $photo->url }}">
                        </a>
                      </div>
                  @endforeach
                </div>
        </div>
	</div>
@endsection
