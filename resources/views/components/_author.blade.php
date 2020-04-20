<div class="author float-right">
  <span class="text-muted">{{$label ." ". $model->created_date }}</span>
  <div class="media">
    <a class="d-flex align-self-bottom" href="{{$model->user->url}}">
        <img src="{{$model->user->avatar}}" alt="User Avatar">
    </a>
    <div class="media-body">
      <a style="font-size:1.4em;" href="{{ $model->user->url }}">{{ $model->user->name }}</a>
    </div>
  </div>
</div>