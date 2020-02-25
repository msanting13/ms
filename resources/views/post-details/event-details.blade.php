@extends('layout-master-post-details')
@section('title',"{$event->event_name}")
@section('coverBackground','/mag/img/bg-img/40.jpg')
@section('breadcrumb')
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
			<li class="breadcrumb-item active"><a href="#">Events</a></li>
		</ol>
	</nav>
@endsection
@section('content')
<div class="post-meta">
	<a href="#">
    		@if($event->is_allDay)
    			@if($event->start_date == $event->end_date)
    				{{ "All day, ".date('F d, Y', strtotime($event->start_date)) }}
    			@else
    				{{ "All day, ".date('F d, Y', strtotime($event->start_date.' - '.$event->end_date)) }}
    			@endif
    		@else
    			@if($event->start_date == $event->end_date)
    				{{ date('h:i A', strtotime($event->start_time)).' - '.date('h:i A', strtotime($event->end_time)).' '.date('F d, Y', strtotime($event->start_date)) }}
    			@else
    				{{ date('h:i A F d, Y', strtotime($event->start_date.$event->start_time)).' - '.date('h:i A F d, Y', strtotime($event->end_date.$event->end_time)) }}
    			@endif
    		@endif
	</a>
	<a href="#">Events</a>
</div>
<h4 class="post-title">{{ $event->title }}</h4>
{!! $event->description !!}
@section('others')
	<!-- Section Title -->
	<div class="section-heading">
		<h5>Other Events</h5>
	</div>
	<!-- Catagory Widget -->
	<ul class="catagory-widgets">
		@foreach($otherEvents as $otherEvent)
			@if($otherEvent->id != $event->id)
				<li>
					<a href="{{ route('event.details',$otherEvent->id) }}">
						<span>
							<i class="fa fa-angle-double-right" aria-hidden="true"></i> 
							{{ $otherEvent->event_name }}
						    <div class="post-meta d-flex justify-content-between">
						    	<small>
						    		@if($otherEvent->is_allDay)
						    			@if($otherEvent->start_date == $otherEvent->end_date)
						    				{{ "All day, ".date('F d, Y', strtotime($otherEvent->start_date)) }}
						    			@else
						    				{{ "All day, ".date('F d, Y', strtotime($otherEvent->start_date.' - '.$otherEvent->end_date)) }}
						    			@endif
						    		@else
						    			@if($otherEvent->start_date == $otherEvent->end_date)
						    				{{ date('h:i A', strtotime($otherEvent->start_time)).' - '.date('h:i A', strtotime($otherEvent->end_time)).' '.date('F d, Y', strtotime($otherEvent->start_date)) }}
						    			@else
						    				{{ date('h:i A F d, Y', strtotime($otherEvent->start_date.$otherEvent->start_time)).' - '.date('h:i A F d, Y', strtotime($otherEvent->end_date.$otherEvent->end_time)) }}
						    			@endif
						    		@endif
						    	</small>
						    </div>
						</span>
					</a>
				</li>
			@endif
		@endforeach
	</ul>
@endsection
@endsection