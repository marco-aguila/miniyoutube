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
                               <a href="{{ route('detailVideo',['video_id' => $video->id]) }}">{{ $video->title }}</a>
                            </h2>
                                <p>Subido por:{{ $video->user->name.' '.$video->user->surname }}</p>
                                <p> </p>
                            
                    </div>
                    <a href="{{ route('detailVideo',['video_id' => $video->id]) }}" class="btn btn-info">Ver Video</a>

                    @if (Auth::check() && Auth::user()->id == $video->user->id)
                        <a href="" class="btn btn-warning" >Editar</a>
                       
                       <!-- Botón en HTML (lanza el modal en Bootstrap) -->
                           <a href="#marcoModal{{ $video->id }}" role="button" class="btn btn-sm btn-danger" data-toggle="modal">Eliminar</a>
                           
                           <!-- Modal / Ventana / Overlay en HTML -->
                           <div id="marcoModal{{ $video->id }}" class="modal fade">
                               <div class="modal-dialog">
                                   <div class="modal-content">
                                       <div class="modal-header">
                                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                           <h4 class="modal-title">¿Estás seguro?</h4>
                                       </div>
                                       <div class="modal-body">
                                           <p>Seguro que quieres borrar el Video:</p>
                                           <p class="text-danger"><small>{{ $video->title }}</small></p>
                                       </div>
                                       <div class="modal-footer">
                                           <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                           <a href="{{ url('delete-video/'.$video->id) }}" type="button" class="btn btn-danger">Eliminar</a>
                                       </div>
                                   </div>
                               </div>
                           </div>
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
