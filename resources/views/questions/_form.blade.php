<div class="form-group">
  <h5 class="card-title">Title</h5>
  <input 
    class="form-control  @error('title') is-invalid @enderror " 
    type="text" 
    name="title" 
    id="title" 
    placeholder="Compose your title here..." 
    aria-describedby="helperTitleId"
    value="{{ old('title', $question->title) }}"
  />
  <small class="text-muted">required characters minimum: (20/0) | maximum: (255/0)</small>
  @error('title')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror
</div>
<div class="form-group">
  <h5 class="card-text">Explaination</h5>
  <textarea 
    class="form-control  @error('body') is-invalid @enderror " 
    name="body" 
    id="body" 
    rows="10" 
    placeholder="Kindly explain your question further here..." 
    aria-describedby="helperBodyId"
    >
    {{ old('body', $question->body) }}
  </textarea>
  <small class="text-muted">minimum characters (150/0)</small>
  @error('body')
      <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
      </span>
  @enderror

</div>
<button type="submit" class="btn btn-lg btn-primary">{{ $btnSubmitText }}</button>