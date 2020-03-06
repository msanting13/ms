@extends('layouts.layout-master')
@section('title',"Research - {$user_research_report->title}")
@section('content')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Research</h1>
		<button type="button" class="btn btn-sm btn-secondary" onclick="goBack()"><i class="fas fa-arrow-left"></i> Back</button>
	</div>
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <a href="{{ route('user-submitted-research-report-details.export-pdf',encrypt($user_research_report->id)) }}" class="btn btn-info btn-sm" style="float:right;" target="_blank">
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
                        <td scope="row">{{ $user_research_report->title }}</td>
                        <td>{{ $user_research_report->short_description }}</td>
                        <td>{{ $user_research_report->project_cost }}</td>
                        <td>{{ $user_research_report->funding_source }}</td>
                        <td>{{ $user_research_report->agency }}</td>
                        <td>{{ $user_research_report->sdgs_addressed }}</td>
                        <td>{{ $user_research_report->beneficiaries }}</td>
                    </tr>
                </tbody>
            </table>
            <label>File: <a href="{{ $user_research_report->url }}">{{ $user_research_report->file }}</label>
		</div>
	</div>
@endsection
