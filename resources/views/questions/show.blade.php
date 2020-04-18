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
        @include('answers._index', [
          'answers' => $question->answers,
          'answersCount' => $question->answers_count,
        ])
        @include('answers._create')
    </div>
    
        
  </div>
@endsection
