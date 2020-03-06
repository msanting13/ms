
<a href="{{ route($showRoute, $card->id) }}" class="btn btn-success btn-icon-split btn-sm">
    <span class="icon text-white-50">
        <i class="fas fa-eye"></i>
    </span>
    <span class="text">Show submitted reports</span>
</a>

<a href="{{ route($createRoute, $card->id) }}" class="btn btn-primary btn-icon-split btn-sm  {{ ($card->is_lock)? 'disabled' : '' }}">
    <span class="icon text-white-50">
        <i class="fas fa-arrow-right"></i>
    </span>
    <span class="text">Submit report</span>
</a>