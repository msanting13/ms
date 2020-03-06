<!-- {!! ($stat === TRUE) ? "<input type='checkbox' class='js-switch switch' id='".uniqid()."' data-id='$id' checked>" : "<input type='checkbox' class='js-switch switch' id='".uniqid()."' data-id='$id'>" !!}
 -->
 <div class="bt-switch">
    <input type="checkbox" class="post-unpost-switch" data-id="{{ $id }}" data-textval="{{ $title }}" data-on-color="success" data-off-color="warning" data-on-text="Post" data-off-text="Unpost" data-size="medium" {{ $stat == true ? 'value=on ' : 'value=off' }} {{ $stat == true ? 'checked=checked ' : '' }}>
</div>