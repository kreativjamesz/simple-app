@extends('layouts.app')

@section('content')
<div id="questions" class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      @include('layouts._messages')
      <div class="card">

        <div class="card-header">
          <div class="d-flex align-items-center">
            <h2>All Questions</h2>
            <div class="ml-auto">
              @guest
                <a href="{{ route('login') }}" class="btn btn-primary">New Question <i data-feather="help-circle" style="width:18px;"></i></a>
              @endguest
              @auth
                <a href="{{ route('questions.create') }}" class="btn btn-primary"><i data-feather="plus-circle" style="width:18px;"></i> New Question</a>
              @endauth
            </div>
          </div>
        </div>

        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif
          @forelse ($questions as $question)
            @include('questions._questions',['question'=>$question])
            @empty
                <div class="alert alert-warning">
                  <strong>Sorry!</strong> There are no questions available
                </div>
          @endforelse
          
          <div class="pagination justify-content-center">
            {{$questions->links()}}
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection
