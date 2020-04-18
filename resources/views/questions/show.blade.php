@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @include('layouts._sidebar')
      <div class="col-md-9">
        {{-- QUESTION --}}
        <div class="row">
          <div class="col-md-12">
            <h1>This is a Question</h1>
            <div class="card">
              <div class="bg-primary text-light card-header">
                {{$question->title}}
              </div>
              <div class="card-body">
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
                      <a href="#" title="Click to mark as favorite question (Click again to undo" class="favorite text-warning">
                        <i class="fas fa-star fa-2x fa-fw"></i>
                        <p class="favorites-count">1234</p>
                      </a>
                    </div>
                  </div>
                  <div class="col-md-10">
                    <div class="media-body">
                      {!!$question->body_html!!}
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-muted">
                <div class="author float-right">
                  <span class="text-muted">Answered {{ $question->created_date }}</span>
                  <div class="media">
                    <a class="d-flex align-self-bottom" href="{{$question->user->url}}">
                        <img src="{{$question->user->avatar}}" alt="User Avatar">
                    </a>
                    <div class="media-body">
                      <a style="font-size:1.4em;" href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        {{-- ANSWER --}}
        <div class="row no-gutters mt-4">
          <div class="col-sm-12 my-2">
            <div class="card">
              <div class="card-header">
                <h2>{{$question->answers_count . " " . Str::plural('Answer', $question->answers_count)}}</h2>
              </div>
            </div>
            @foreach ($question->answers as $answer)
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
    </div>
    
        
  </div>
@endsection
