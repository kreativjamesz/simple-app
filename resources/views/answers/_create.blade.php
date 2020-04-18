<div class="row no-gutters mt-4">
  <div class="col-sm-12 my-2">
    <hr>
    <h1>Your Answer</h1>
    <form action="{{ route('questions.answers.store', $question->id) }}" method="post">
      @csrf
      <div class="form-group">
        <div id="toolbar-container"></div>
        <textarea class="form-control {{$errors->has('body') ? 'is-invalid' : ''}}" name="body" id="editor" rows="10"></textarea>
        @if($errors->has('body'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
          </div>
        @endif
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Save Answer</button>
      </div>
    </form>
  </div>
</div>