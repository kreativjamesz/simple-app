@if ($model instanceof App\Question)
  @php
      $name = 'question';
      $firstURISegment = 'questions';
  @endphp
@elseif ($model instanceof App\Answer)
  @php
      $name = 'answer';
      $firstURISegment = 'answers';
  @endphp
@endif
@php
    $formId = $name."-".$model->id;
    $formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp
<div class="d-flex flex-column justify-content-center align-items-center vote-controls">
  <a href="#" 
     title="This answer is useful" 
     class="vote-up {{Auth::guest() ? 'text-muted':''}}"
     onclick="event.preventDefault(); document.getElementById('up-vote-{{$formId}}').submit();">
    <i class="fas fa-caret-up fa-4x fa-fw"></i>
  </a>
  <form id="up-vote-{{$formId}}" action="{{$formAction}}" method="post">
    @csrf
    <input type="hidden" name="vote" value="1"/>
  </form>
  <span class="votes-count fa-lg text-muted">{{$model->votes_count}}</span>
  <a href="#" 
     title="This answer is useless"
     class="vote-down {{Auth::guest() ? 'text-muted':''}}"
     onclick="event.preventDefault(); document.getElementById('down-vote-{{$formId}}').submit();">
    <i class="fas fa-caret-down fa-4x fa-fw"></i>
  </a>
  <form id="down-vote-{{$formId}}" action="{{$formAction}}" method="post">
    @csrf
    <input type="hidden" name="vote" value="-1"/>
  </form>

  @if($model instanceof App\Question)
    @include('components._favorite',[
      'model' => $model
    ])
  @elseif($model instanceof App\Answer)
    @include('components._accept',[
      'model' => $model
    ])
  @endif
</div>