<a title="Click to mark as favorite {{ $name }} (Click again to undo)" class="favorite {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '') }} mt-3">
    <i class="fas fa-star fa-2x"
       onclick="event.preventDefault(); document.getElementById('favorite-{{ $name }}-{{ $model->id }}').submit()"></i>
    <span class="favorites-count">{{ $model->favorites_count }}</span>
</a>
<form style="display: none;" id="favorite-{{ $name }}-{{ $model->id }}" action="/{{ $firstURISegment }}/{{ $model->id }}/favorites" method="POST">
    @csrf
    @if($model->is_favorited)
        @method('DELETE')
    @endif
</form>
