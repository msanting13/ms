@foreach($events as $event)
    <div class="post-meta d-flex justify-content-between">
    	<a href="#">{{-- {{ date('F d, Y', strtotime($event->start_date)) }} --}}
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
    </div>
    <a href="{{ route('event.details', $event->id) }}" class="post-title">{{ $event->event_name }}</a>
    <hr>
@endforeach
