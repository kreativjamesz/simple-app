<div class="media data-questions">
  <div class="d-flex flex-column counters">
    <div class="rating">
      <strong>{{ $question->votes_count }}</strong> {{Str::plural('rating', $question->votes_count) }}
    </div>
    <div class="status {{ $question->status }}">
      <strong>{{ $question->answers_count }}</strong> {{Str::plural('answer', $question->answers_count) }}
    </div>
    <div class="views">
      {{ $question->views . " " . Str::plural('view', $question->views) }}
    </div>
  </div>
  <div class="media-body">
    <div class="d-flex align-items-center">
        <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
        
        <div class="ml-auto d-flex">
          @auth
            @can('update',$question)
              @if(Auth::user()->can('update-question',$question))
                <a href="{{route('questions.edit', $question->id)}}" class="btn btn-sm btn-warning"><i data-feather="edit" style="width:18px;"></i></a>
              @endif
            @endcan
            @can('delete',$question)
              @if(Auth::user()->can('delete-question',$question))
                <form action="{{ route('questions.destroy',$question->id) }}" method="post">
                  @method('DELETE')
                  @csrf
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i data-feather="trash" style="width:18px;"></i></button>
                </form>
              @endif
            @endcan
          @endauth
        </div>
    </div>
    <p class="lead">
      Asked by: 
      <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
      <small class="text-muted">{{ $question->created_date }}</small>
    </p>
    <div class="excerpt">{{$question->excerpt(350)}}</div>
  </div>
</div>