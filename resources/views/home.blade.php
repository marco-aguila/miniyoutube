@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif   
            
            <ul id="videos-list">
                @foreach ($videos as $video)
                    <li class="video-item col-md-4 pull-left">
                        <!--Image of video-->
                        @if (Storage::disk('images')->has($video->image))
                        <div class="video-image-thumb">
                            <div class="col-md-6 col-md-offset-3">
                                <img style="max-width: 100%;" src="{{ url('miniatura/'.$video->image) }}" alt="{{ $video->description }}">
                            </div>
                        </div>
                        @endif
                        <div class="data">
                            <h4>
                                {{ $video->title }}
                            </h4>
                        </div>
                        <!--Botones de Acciones-->
                    </li>
                @endforeach
            </ul>        
        </div>
    {{ $videos->links() }}
</div>
@endsection
