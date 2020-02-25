@extends('layout-master-post-details')
@section('title',"{$news->title}")
@section('coverBackground',(is_null($news->cover_photos))? '/public_files/image/news/default-cover.jpg' : '/public_files/image/news/'.$news->cover_photos)
@section('cover')
	<img src="/public_files/image/news/{{ (is_null($news->cover_photos))? 'default-cover.jpg' : $news->cover_photos }}">
@endsection
@section('breadcrumb')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
			<li class="breadcrumb-item active"><a href="#">News</a></li>
		</ol>
	</nav>
@endsection
@section('content')
<div class="post-meta">
	<a href="#">{{ date('F d, Y', strtotime($news->created_at)) }}</a>
	<a href="archive.html">News</a>
</div>
<h4 class="post-title">{{ $news->title }}</h4>
{!! $news->content !!}
<!-- Post Author -->
<div class="post-author d-flex align-items-center">
	<div class="post-author-desc pl-4">
		<a href="#" class="author-name">-- {{ $news->author }}</a>
	</div>
</div>
@section('others')
	<!-- Section Title -->
	<div class="section-heading">
		<h5>Other News</h5>
	</div>
	<!-- Catagory Widget -->
	<ul class="catagory-widgets">
		@foreach($otherNews as $othernews)
		@if($othernews->id != $news->id)
		<li><a href="{{ route('news.details',$othernews->id) }}"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $othernews->title }}</span></a></li>
		@endif
		@endforeach
	</ul>
@endsection
@endsection