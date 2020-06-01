@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card" style="border-radius: 20px;">
             <h1 style="text-align: center; font-size:3em; font-weight: bold; padding:10px;">{{ $video->title }}</h1>
            <hr>
            <div class="col-md-12">
                <!--VIDEO-->
                <video id="video-player" width="100%"  controls>
                    <source src="{{ route('fileVideo',['filename' => $video->video_path ]) }}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
                <!--DESCRIPTION-->
                <div class="panel panel-default video-data">
                    <div class="panel-heading">

                        <div class="panel-title">
                            Subido por  <strong>{{ $video->user->name.' '.$video->user->surname }}</strong>
                             <br> CREADO {{ \FormatTime::LongTimeFilter($video->created_at) }}
                        </div>
                    </div>
                    <div class="panel-body">
                        {{ $video->description }}
                    </div>
                </div>
                <!--COMENTS-->
                    @include('video.comments')                
            </div>
        </div>
    </div><!--Fin de contenedor-->
@endsection
