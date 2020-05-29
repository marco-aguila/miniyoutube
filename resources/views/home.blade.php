@extends('layouts.app')

@section('content')
<div class="container">
   
        @if (session('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif   
            
            <div id="videos-list">
                
                @foreach ($videos as $video)
                <div class="video-item col-md-10 pull-left panel panel-default">
                    <div class="card" style="margin-bottom: 15px; padding:10px">
                    <div class="panel-body">
                        <!--Image of video-->
                        @if (Storage::disk('images')->has($video->image))
                        <div class="video-image-thumb col-md-3 pull-left">
                                <div class="video-image-mask">
                                    <img class="video-image"  src="{{ url('miniatura/'.$video->image) }}" alt="{{ $video->description }}">
                                </div>
                        </div>
                        @endif
                        <div class="data">
                            <h2 class="video-title">
                               <a href="">{{ $video->title }}</a> 
                                <p>Subido por:{{ $video->user->name.' '.$video->user->surname }}</p>
                                <p> </p>
                            </h2>
                    </div>
                    <a href="" class="btn btn-info">Ver Video</a>

                    @if (Auth::check() && Auth::user()->id == $video->user->id)
                        <a href="" class="btn btn-warning" >Editar</a>
                        <a href="" class="btn btn-danger">Eliminar</a>
                    @endif
                        <!--Botones de Acciones-->
                    </div>
                    </div>
                 </div>
                @endforeach
            </div>           
    {{ $videos->links() }}
</div>
@endsection
