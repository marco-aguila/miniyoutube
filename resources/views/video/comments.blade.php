<hr>
<h4>Comentarios</h4>
<hr>
@if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
@endif   
@if (Auth::check())
<form method="POST" action="{{ url('/comment') }}" class="col-md-10">
    {{ csrf_field() }}
    <input type="hidden" name="video_id" value="{{ $video->id }}" required />
    <p>
        <textarea name="body" class="form-control" required style="width: 100%;" ></textarea>
    </p>
        <input type="submit" value="Comentar" class="btn btn-info "/>
</form>
@endif

@if (isset($video->comments))
<hr>
<h5>Comentarios</h5>
    <div class="comments-list" style="border: solid black 1px; margin:10px;">
        @foreach ($video->comments as $comment)
            <div class="comment-item com-md-12 pull-left">
                <div class="panel panel-default comment-data"style="padding: 10px;">
                    <div class="panel-heading" >

                        <div class="panel-title">
                            Subido por  <strong>{{ $comment->user->name.' '.$comment->user->surname }}</strong>
                            {{ \FormatTime::LongTimeFilter($comment->created_at) }}
                        </div>
                    </div>
                    <div class="panel-body">
                       <strong> {{ $comment->body }}</strong>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endif