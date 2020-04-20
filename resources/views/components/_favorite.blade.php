<a 
  href="#" 
  title="Click to mark as favorite question (Click again to undo" 
  class="favorite {{ Auth::guest() ? 'text-info' : ($question->is_favorited ? 'text-warning' : 'text-muted') }}"
  onclick="event.preventDefault(); document.getElementById('favorite-question-{{$question->id}}').submit();"
  >
  <i class="fas fa-star fa-2x fa-fw"></i>
  <p class="favorites-count text-center">{{$question->favorites_count}}</p>
</a>
<form id="favorite-question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="post">
  @csrf
  @if($question->is_favorited)
    @method('DELETE')
  @endif
</form>