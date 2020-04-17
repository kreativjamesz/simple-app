@extends('layouts.app')

@section('content')
<div class="container">
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

          @foreach ($questions as $question)
            <div class="media">
              <div class="d-flex flex-column counters">
                <div class="rating">
                  <strong>{{ $question->ratings }}</strong> {{Str::plural('rating', $question->ratings) }}
                </div>
                <div class="status {{ $question->status }}">
                  <strong>{{ $question->answers }}</strong> {{Str::plural('answer', $question->answers) }}
                </div>
                <div class="views">
                  {{ $question->views . " " . Str::plural('view', $question->views) }}
                </div>
              </div>
              <div class="media-body">
                <div class="d-flex align-items-center">
                    <h3 class="mt-0"><a href="{{ $question->url }}">{{ $question->title }}</a></h3>
                    
                    <div class="ml-auto d-flex">
                      @auth
                        @can('update',$question)
                          @if(Auth::user()->can('update-question',$question))
                            <a href="{{route('questions.edit', $question->id)}}" class="btn btn-sm btn-warning"><i data-feather="edit" style="width:18px;"></i> Edit</a>
                          @endif
                        @endcan
                        @can('delete',$question)
                          @if(Auth::user()->can('delete-question',$question))
                            <form action="{{ route('questions.destroy',$question->id) }}" method="post">
                              @method('DELETE')
                              @csrf
                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i data-feather="trash" style="width:18px;"></i></button>
                            </form>
                          @endif
                        @endcan
                      @endauth
                    </div>
                </div>
                <p class="lead">
                  Asked by: 
                  <a href="{{ $question->user->url }}">{{ $question->user->name }}</a>
                  <small class="text-muted">{{ $question->created_date }}</small>
                </p>
                {{ Str::limit($question->body,250) }}
              </div>
            </div>
            <hr>
          @endforeach

          {{$questions->links()}}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
