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
                <a href="#" title="This title is useful" class="vote-up">
                  <i class="fas fa-caret-up fa-4x fa-fw text-muted"></i>
                </a>
                <span class="votes-count fa-lg text-muted">1234</span>
                <a href="#" title="">
                  <i class="fas fa-caret-down fa-4x fa-fw text-muted"></i>
                </a>
                <a href="#" title="Click to mark as favorite question (Click again to undo" class="vote-accepted text-success">
                  <i class="fas fa-check fa-2x fa-fw"></i>
                  <p class="favorites-count">1234</p>
                </a>
              </div>
            </div>
            <div class="col-md-10">
              <div class="card-text">{!! $answer->body_html !!}</div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <div class="author float-right">
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