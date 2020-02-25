@extends('layout-master-post-details')
@section('title',"{$announcement->title}")
@section('coverBackground','/mag/img/bg-img/40.jpg')
@section('breadcrumb')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
			<li class="breadcrumb-item active"><a href="#">Announcement</a></li>
		</ol>
	</nav>
@endsection
@section('content')
<div class="post-meta">
	<a href="#">{{ date('F d, Y', strtotime($announcement->created_at)) }}</a>
	<a href="archive.html">Announcements</a>
</div>
<h4 class="post-title">{{ $announcement->title }}</h4>
{!! $announcement->content !!}
@section('others')
	<!-- Section Title -->
	<div class="section-heading">
		<h5>Other Announcements</h5>
	</div>
	<!-- Catagory Widget -->
	<ul class="catagory-widgets">
		@foreach($otherAnnouncements as $otherAnnouncement)
			@if($otherAnnouncement->id != $announcement->id)
				<li><a href="{{ route('announcement.details',$otherAnnouncement->id) }}"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $otherAnnouncement->title }}</span></a></li>
			@endif
		@endforeach
	</ul>
@endsection
@endsection