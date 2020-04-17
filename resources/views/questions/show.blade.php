@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @include('layouts._sidebar')
      <div class="col-md-9">
        <h1>This is a Question</h1>
        <div class="card">
          <div class="bg-primary text-light card-header">
            {{$question->title}}
          </div>
          <div class="card-body">
            {!!$question->body_html!!}
            
          </div>
          <div class="card-footer text-muted">
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
