<div class="table-responsive">
	<table class="table table-hover table-striped">
{{-- 		<tbody> --}}
			<tr>
				<th>Research Title: </th>
				<td>{{ $research_report->title }}</td>
			</tr>			
			<tr>
				<th>Description: </th>
				<td>{{ $research_report->short_description }}</td>
			</tr>
			<tr>
				<th>Project cost: </th>
				<td>{{ $research_report->project_cost }}</td>
			</tr>
			<tr>
				<th>Funding Source: </th>
				<td>{{ $research_report->funding_source }}</td>
			</tr>
			<tr>
				<th>Agency: </th>
				<td>{{ $research_report->agency }}</td>
			</tr>
			<tr>
				<th>SDG's addressed: </th>
				<td>{{ $research_report->sdg_addressed }}</td>
			</tr>
			<tr>
				<th>Beneficiaries: </th>
				<td>{{ $research_report->beneficiaries }}</td>
			</tr>
			<tr>
				<th>Attachment: </th>
				<td><a href="/public_files/{{ $research_report->file }}">{{ $research_report->file }}</a></td>
			</tr>
			<tr>
				<th>Submmitted by: </th>
				<td>{{ $research_report->users->name." | ".$research_report->users->campuses }}</td>
			</tr> 
			<tr>
				<th>Submmitted at: </th>
				<td>{{ date('F d, Y h:i A', strtotime($research_report->created_at)) }}</td>
			</tr> 
			<tr>
				<th>Updated at: </th>
				<td>{{ date('F d, Y h:i A', strtotime($research_report->updated_at)) }}</td>
			</tr> 
{{-- 		</tbody> --}}
	</table>
</div>