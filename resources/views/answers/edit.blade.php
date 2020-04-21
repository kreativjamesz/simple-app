@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row no-gutters mt-4">
    <div class="col-sm-12 my-2">
      <hr>
      <h1><span class="fa-xs">Editing answer for question:</span><br> <strong>{{$question->title}}</strong></h1>
      <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
          <div id="toolbar-container"></div>
          <textarea class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" name="body" id="editor" rows="10">{{ old('body',$answer->body) }}</textarea>
          @if($errors->has('body'))
            <div class="invalid-feedback">
              <strong>{{ $errors->first('body') }}</strong>
            </div>
          @endif
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection