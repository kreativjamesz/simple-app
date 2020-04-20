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
                      <a href="#" 
                         title="This title is useful" 
                         class="vote-up {{ Auth::guest() ? 'text-muted':''}}"
                         onclick="event.preventDefault(); document.getElementById('up-vote-question-{{$question->id}}').submit();">
                        <i class="fas fa-caret-up fa-4x fa-fw"></i>
                      </a>
                      <form id="up-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="post">
                        @csrf
                        <input type="hidden" name="vote" value="1"/>
                      </form>
                      <span class="votes-count fa-lg text-muted">{{$question->votes_count}}</span>
                      <a href="#" 
                         title=""
                         class="vote-down {{ Auth::guest() ? 'text-muted':''}}"
                         onclick="event.preventDefault(); document.getElementById('down-vote-question-{{$question->id}}').submit();">
                        <i class="fas fa-caret-down fa-4x fa-fw"></i>
                      </a>
                      <form id="down-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="post">
                        @csrf
                        <input type="hidden" name="vote" value="-1"/>
                      </form>
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
        @include('answers._index', [
          'answers' => $question->answers,
          'answersCount' => $question->answers_count,
        ])
        @include('answers._create')
    </div>
    
        
  </div>
@endsection
