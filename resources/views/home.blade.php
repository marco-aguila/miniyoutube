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
