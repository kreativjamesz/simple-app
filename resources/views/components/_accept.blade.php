@can('accept', $model)
  <a href="#" title="Click this answer as best answer" 
    class="{{ $model->status }}"
    onclick="event.preventDefault(); if(confirm('Are you sure?')) {document.getElementById('accept-answer-{{$model->id}}').submit();}"
    >
    <i class="fas fa-check fa-2x fa-fw"></i>
  </a>
  <form id="accept-answer-{{$model->id}}" action="{{ route('answers.accept', $model->id) }}" method="post">
    @csrf
  </form>
    
  @else
    @if ($model->is_best)
      <a href="#" title="The question owner accepted this answer as best answer" 
        class="{{ $model->status }}">
        <i class="fas fa-check fa-2x fa-fw"></i>
      </a>
    @endif
@endcan