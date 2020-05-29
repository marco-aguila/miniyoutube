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

                <!--COMENTS-->

            </div>
        </div>
    </div><!--Fin de contenedor-->
@endsection
