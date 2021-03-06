@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      @include('layouts._sidebar')
      <div class="col-md-9">
        <h1>New Question</h1>
        <div class="card">
          <div class="bg-primary text-light card-header">
            Compose a question
          </div>
          <div class="card-body">
            <form action="{{route('questions.store')}}" method="POST">
              @csrf
              @include('questions._form',['btnSubmitText' => 'Post New Question'])
            </form>
          </div>
          <div class="card-footer text-muted">
            <small>Make sure to fill all required fields <span class="text-danger">*</span></small>  
          </div>
        </div>
        <hr>
        @include('layouts._table',['tableDataId'=>1,'tableDataTitle'=>"Title",'tableDataBody'=>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque placeat dolores nemo necessitatibus minus est eos animi accusamus ea sint vero voluptatem nesciunt amet tenetur quidem commodi praesentium, fugiat at?"])
      </div>
    </div>
  </div>
@endsection
