@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Crear un nuevo video</h1>

  <div class="row" style="background-color: #ddd">

        <form action="{{ route('saveVideo') }}" method="POST" enctype="multipart/form-data" class="col-lg" style="padding: 20px;">
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
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Descripcion</label>
                <textarea class="form-control" id="description" name="description" value="{{ old('description') }}"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Miniatura</label>
                <input type="file" class="form-control" id="image" name="image" >
            </div>
            <div class="form-group">
                <label for="video">Archivo de Video</label>
                <input type="file" class="form-control" id="video" name="video">
            </div>
            <button type="submit" class="btn btn-success btn-block">Crear Video</button>
            <br>
        </form>
   
  </div>
</div>
@endsection
