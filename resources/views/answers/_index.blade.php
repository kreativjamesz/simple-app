<div class="row no-gutters mt-4">
  <div class="col-sm-12 my-2">
    <div class="card">
      <div class="card-header">
        <h2>{{ $answersCount . " " . Str::plural('Answer', $answersCount)}}</h2>
      </div>
    </div>
    @include('layouts._messages')
    @foreach ( $answers as $answer )
      <div class="card mb-4">
        <div class="card-body mt-4">
          <div class="row">
            <div class="col-md-2">
              <div class="d-flex flex-column justify-content-center align-items-center vote-controls">
                <a href="#" 
                   title="This answer is useful" 
                   class="vote-up {{Auth::guest() ? 'text-muted':''}}"
                   onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{$answer->id}}').submit();">
                  <i class="fas fa-caret-up fa-4x fa-fw"></i>
                </a>
                <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="post">
                  @csrf
                  <input type="hidden" name="vote" value="1"/>
                </form>
                <span class="votes-count fa-lg text-muted">{{$answer->votes_count}}</span>
                <a href="#" 
                   title="This answer is useless"
                   class="vote-down {{Auth::guest() ? 'text-muted':''}}"
                   onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{$answer->id}}').submit();">
                  <i class="fas fa-caret-down fa-4x fa-fw"></i>
                </a>
                <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="post">
                  @csrf
                  <input type="hidden" name="vote" value="-1"/>
                </form>
                @can('accept', $answer)
                  <a href="#" title="Click this answer as best answer" 
                    class="{{ $answer->status }}"
                    onclick="event.preventDefault(); if(confirm('Are you sure?')) {document.getElementById('accept-answer-{{$answer->id}}').submit();}"
                    >
                    <i class="fas fa-check fa-2x fa-fw"></i>
                  </a>
                  <form id="accept-answer-{{$answer->id}}" action="{{ route('answers.accept', $answer->id) }}" method="post">
                    @csrf
                  </form>
                    
                @else
                  @if ($answer->is_best)
                    <a href="#" title="The question owner accepted this answer as best answer" 
                      class="{{ $answer->status }}">
                      <i class="fas fa-check fa-2x fa-fw"></i>
                    </a>
                  @endif
                @endcan
              </div>
            </div>
            <div class="col-md-10">
              <div class="card-text">{!! $answer->body_html !!}</div>
            </div>
          </div>
        </div>
        <div class="card-footer d-flex">
          <div class="d-flex justify-content-center mr-auto">
            @auth
              @can('update',$answer)
                @if(Auth::user()->can('update-answer',$answer))
                  <div>
                    <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-warning"><i data-feather="edit" style="width:18px;"></i> Edit</a>
                  </div>
                @endif
              @endcan
              @can('delete',$answer)
                @if(Auth::user()->can('delete-answer',$answer))
                  <form action="{{ route('questions.answers.destroy',[$question->id, $answer->id]) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i data-feather="trash" style="width:18px;"></i> Delete</button>
                  </form>
                @endif
              @endcan
            @endauth
          </div>
          <div class="author">
            <span class="text-muted">Answered {{ $answer->created_date }}</span>
            <div class="media">
              <a class="d-flex align-self-bottom" href="{{$answer->user->url}}">
                  <img src="{{$answer->user->avatar}}" alt="User Avatar">
              </a>
              <div class="media-body">
                <a style="font-size:1.4em;" href="{{ $answer->user->url }}">{{ $answer->user->name }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>