@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div class="row">
            <h1>Editar {{ $video->title }}</h1>
            <form action="{{ route('updateVideo', ['video_id' => $video->id ]) }}" method="POST" enctype="multipart/form-data" class="col-lg" style="padding: 20px;">
                {!! csrf_field() !!}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                                @foreach ($errors->all() as  $error)
                                   <li>{{ $error }}</li>  
                                @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="title">Titulo</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $video->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Descripcion</label>
                    <input class="form-control" id="description" name="description" value="{{ $video->description}}">
                </div>
                <div class="form-group">
                    <label for="image">Miniatura</label>
                    <!--Image of video-->
                    @if (Storage::disk('images')->has($video->image))
                            <div class="video-image-mask">
                                <img class="video-image"  src="{{ url('miniatura/'.$video->image) }}" alt="{{ $video->description }}">
                            </div>
                    @endif
                    <input type="file" class="form-control" id="image" name="image" >
                </div>
                <div class="form-group">
                   
                    <label for="video">Vista Previa de Video</label><br>
                     <video id="video-player" width="25%"  controls>
                        <source src="{{ route('fileVideo',['filename' => $video->video_path ]) }}" type="video/mp4">
                      Your browser does not support the video tag.
                    </video>
                    <input type="file" class="form-control" id="video" name="video">
                </div>
                <button type="submit" class="btn btn-success btn-block">Editar Video</button>
                <br>
            </form>

        </div>
    </div>

@endsection