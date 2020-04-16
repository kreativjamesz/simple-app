@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @include('layouts._sidebar')
      <div class="col-md-9">
        <h1>Edit Question</h1>
        <div class="card">
          <div class="bg-primary text-light card-header">
            Compose a question
          </div>
          <div class="card-body">
            <form action="{{route('questions.update', $question->id)}}" method="POST" class="form-inline">
              @method('PUT')
              @csrf
              @include('questions._form',['btnSubmitText' => 'Update Question'])
            </form>
          </div>
          <div class="card-footer text-muted">
            <small>Make sure to fill all required fields <span class="text-danger">*</span></small>  
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>
@endsection
