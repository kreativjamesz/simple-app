@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @include('layouts._sidebar')
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-12">
            <h1>This is a Question</h1>
            <div class="card">
              <div class="bg-primary text-light card-header">
                {{$question->title}}
              </div>
              <div class="card-body">
                {!!$question->body_html!!}
                
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
                      <div class="bg-light text-success p-2" style="border-radius: 4px;">
                        <div class="d-flex align-items-center text-success" style="flex-direction: column">
                          <a href="#" class="text-success" onclick="return alert('Increase vote');"><i data-feather="chevrons-up" style="width:24px;"></i></a>
                          <span class="text-success" style="font-size:2em;">5</span>
                          <a href="#" class="text-success" onclick="return alert('Decrease vote');"><i data-feather="chevrons-down" style="width:24px;"></i></a>
                        </div>
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
