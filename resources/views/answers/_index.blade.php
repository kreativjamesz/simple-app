@if($answersCount > 0)
<div id="answers">
  <div class="row no-gutters mt-4">
    <div class="col-sm-12 my-2">
      <div class="card">
        <div class="card-header">
          <h2>{{ $answersCount . " " . Str::plural('Answer', $answersCount)}}</h2>
        </div>
      </div>
      @include('layouts._messages')
      @foreach ( $answers as $answer )
        @include('answers._answer',['answer'=>$answer])
      @endforeach
    </div>
  </div>
</div>
@endif