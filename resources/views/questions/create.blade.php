@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-3">
        <h1>Options</h1>
        <div class="list-group">
          <a href="/user/profile" class="list-group-item list-group-item-action p-5 d-flex justify-content-center">
            <img src="/images/avatar/default.jpg" class="img-fluid rounded-circle" alt="$user->name" width="150"/>
          </a>
          <a href="#" class="list-group-item list-group-item-action">Profile</a>
          <a href="#" class="list-group-item list-group-item-action">Questions</a>
          <a href="#" class="list-group-item list-group-item-action">Categories</a>
          <a href="#" class="list-group-item list-group-item-action">Products</a>
          <a href="#" class="list-group-item list-group-item-action disabled">Disabled item</a>
        </div>
      </div>
      <div class="col-md-9">
        <h1>New Question</h1>
        <div class="card">
          <div class="bg-primary text-light card-header">
            Compose a question
          </div>
          <div class="card-body">
            <form action="{{route('questions.store')}}" method="POST">
              @csrf
              <div class="form-group">
                <h5 class="card-title">Title</h5>
                <input 
                  class="form-control  @error('title') is-invalid @enderror " 
                  type="text" 
                  name="title" 
                  id="title" 
                  placeholder="Compose your title here..." 
                  aria-describedby="helperTitleId"
                  value="{{ old('title') }}"
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
                  {{ old('body') }}
                </textarea>
                <small class="text-muted">minimum characters (150/0)</small>
                @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

              </div>
              <button type="submit" class="btn btn-lg btn-primary">{{ __('Save') }}</button>
              <button type="submit" class="btn btn-lg btn-warning">Clear</button>
            </form>
          </div>
          <div class="card-footer text-muted">
            <small>Make sure to fill all required fields <span class="text-danger">*</span></small>  
          </div>
        </div>
        <hr>
        <table class="table table-primary table-light table-hovered">
          <thead class="bg-primary text-light">
            <tr>
              <th>id</th>
              <th>title</th>
              <th>body</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td scope="row">1</td>
              <td>Lorem ipsum</td>
              <td>dolor sit amet consectetur adipisicing elit. Repellat accusamus vitae sint cupiditate voluptatum ipsa laboriosam minima</td>
              <td class="d-flex">
                <a href="#" class="btn btn-sm btn-success m-1"><i data-feather="eye" style="width:24px;"></i></a>
                <a href="#" class="btn btn-sm btn-warning m-1"><i data-feather="edit" style="width:24px;"></i></a>
                <a href="#" class="btn btn-sm btn-danger m-1"><i data-feather="trash" style="width:24px;"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
