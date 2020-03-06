<form action="{{ route('events.update', $event->id) }}" method="POST" role="form">
	<div class="form-group">
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<label for="eventName">Event name *</label>
		<input type="text" id="eventName" name="name" class="form-control" value="{{ $event->event_name }}" required>
	</div>	
	<div class="form-group">
		<label for="location">Location *</label>
		<input type="text" id="location" name="location" class="form-control" value="{{ $event->location }}" required>
	</div>
	<label>Start</label>
	<div class="row">					
		<div class="form-group col-md-7">
			<div class="input-group date" id="startDateTimePicker">
				<input type='text' class="form-control" id="startdate" name="startdate" value="{{ date("m/d/Y",strtotime($event->start_date)) }}" placeholder="Date">
				<div class="input-group-append input-group-addon">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-calendar fa-sm"></i>
					</button>
				</div>
			</div>
		</div>	
		<div class="form-group col-md-5">
			<div class="input-group date" id="startTimeDateTimePicker">
				<input type='text' class="form-control" id="startime" name="starttime" {{ (!$event->is_allDay) ? 'value="'.date('h:i A', strtotime($event->start_time)).'"' : 'disabled' }} placeholder="Time">
				<div class="input-group-append input-group-addon">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-clock fa-sm"></i>
					</button>
				</div>
			</div>
		</div>	
	</div>
	<label>End</label>
	<div class="row">					
		<div class="form-group col-md-7">
			<div class="input-group date" id="endDateTimePicker">
				<input type='text' class="form-control" id="enddate" name="enddate" value="{{ date("m/d/Y",strtotime($event->end_date)) }}" placeholder="Date">
				<div class="input-group-append input-group-addon">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-calendar fa-sm"></i>
					</button>
				</div>
			</div>
		</div>	
		<div class="form-group col-md-5">
			<div class="input-group date" id="endtimeDateTimePicker">
				<input type='text' class="form-control" id="endtime" name="endtime" {{ (!$event->is_allDay) ? 'value="'.date('h:i A', strtotime($event->end_time)).'"' : 'disabled' }} placeholder="Time">
				<div class="input-group-append input-group-addon">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-clock fa-sm"></i>
					</button>
				</div>
			</div>
		</div>	
	</div>
	<div class="form-group">
		<input type='checkbox' class='js-switch all-day edit-all-day' id="allDay" name="allday" {{ (!$event->is_allDay) ? 'value=false' : 'value=true checked' }}><label>All day</label>
	</div>
	<div class="form-group">
		<label>Description *</label>
		<textarea class="form-control makeMeRichTextareaEdit" id="{{ uniqid() }}" name="description" required>{!! $event->description !!}</textarea>
	</div>		
	<button type="submit" class="btn btn-primary btn-icon-split">
		<span class="icon text-white-50">
			<i class="fas fa-edit"></i>
		</span>
		<span class="text">Update</span>
	</button>				
</form>
<script type="text/javascript">
	$(document).ready(function() {
		$('.makeMeRichTextareaEdit').each( function () {
			CKEDITOR.replace(this.id,options)
		});
	});
	initDateTimePicker();
	initJSwitch('.edit-all-day');
</script>
