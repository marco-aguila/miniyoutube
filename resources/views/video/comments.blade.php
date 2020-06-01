<hr>
<h4>Comentarios</h4>
<hr>
@if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
@endif   

<form method="POST" action="{{ url('/comment') }}" class="col-md-10">
    {{ csrf_field() }}
    <input type="hidden" name="video_id" value="{{ $video->id }}" required />
    <p>
        <textarea name="body" class="form-control" required style="width: 100%;" ></textarea>
    </p>
        <input type="submit" value="Comentar" class="btn btn-info "/>
</form>