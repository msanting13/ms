@foreach($announcements as $announcement)
    <div class="post-meta d-flex justify-content-between">
    	<a href="#">{{ date('F d, Y', strtotime($announcement->updated_at)) }}</a>
    </div>
    <a href="{{ route('announcement.details', $announcement->id) }}" class="post-title">{{ $announcement->title }}</a>
    <hr>
@endforeach
