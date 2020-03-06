
@if(!$report->is_published)
    <a href="javascript:void(0)" class="btn btn-warning btn-icon-split btn-sm btn-post" title="Delete" data-id="{{ $report->id }}">
        <span class="icon text-white-50">
            <i class="fas fa-paper-plane"></i>
        </span>
        <span class="text">Post</span>
    </a>
    <form id="post-form{{ $report->id }}" action="{{ route('user-extension-reports.post', $report->id) }}" method="POST">
        @csrf
        <input name="_method" type="hidden" value="PUT">
    </form>
@endif

<a href="{{ route('user-extension-reports.show', $report->id) }}" class="btn btn-success btn-icon-split btn-sm">
    <span class="icon text-white-50">
        <i class="fas fa-eye"></i>
    </span>
    <span class="text">Show</span>
</a>

<a href="{{ route('user-extension-reports.edit', $report->id) }}" class="btn btn-primary btn-icon-split btn-sm">
    <span class="icon text-white-50">
        <i class="fas fa-edit"></i>
    </span>
    <span class="text">Edit</span>
</a>

@if(!$report->is_published)
    <a class="btn btn-danger btn-icon-split btn-sm btn-delete" href="javascript:void(0)" title="Delete" data-id="{{ $report->id }}" data-textval="{{ $report->title }}">
        <span class="icon text-white-50">
            <i class="fas fa-trash"></i>
        </span>
        <span class="text">Delete</span>
    </a>
    <form id="delete-form{{ $report->id }}" action="{{ route('user-extension-reports.destroy', $report->id) }}" method="POST">
        @csrf
        <input name="_method" type="hidden" value="DELETE">
    </form>
@endif