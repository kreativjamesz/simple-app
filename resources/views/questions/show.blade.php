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
                    @include('components._vote',[
                      'model' => $question
                    ])
                  </div>
                  <div class="col-md-10">
                    <div class="media-body">
                      {{$question->excerpt(350)}}
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="col-4"></div> --}}
              {{-- <div class="col-4"></div> --}}
              {{-- <div class="col-4"></div> --}}
              <div class="card-footer text-muted">
                @include('components._author',[
                  'label'=> 'Asked by:',
                  'model'=> $question,
                ])

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
