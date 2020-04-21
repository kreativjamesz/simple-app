<div class="card mb-4">
  <div class="card-body mt-4">
    <div class="row">
      <div class="col-md-2">
        @include('components._vote',[
          'model' => $answer
        ])
      </div>
      <div class="col-md-10">
        <div class="card-text">{!! $answer->body_html !!}</div>
      </div>
    </div>
  </div>
  <div class="card-footer d-flex">
    <div class="d-flex justify-content-center mr-auto">
      @auth
        @can('update',$answer)
          @if(Auth::user()->can('update-answer',$answer))
            <div>
              <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-warning"><i data-feather="edit" style="width:18px;"></i></a>
            </div>
          @endif
        @endcan
        @can('delete',$answer)
          @if(Auth::user()->can('delete-answer',$answer))
            <form action="{{ route('questions.answers.destroy',[$question->id, $answer->id]) }}" method="post">
              @method('DELETE')
              @csrf
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i data-feather="trash" style="width:18px;"></i></button>
            </form>
          @endif
        @endcan
      @endauth
    </div>
    @include('components._author',[
      'model'=> $answer,
      'label'=> 'Answered by:',
    ])
  </div>
</div>