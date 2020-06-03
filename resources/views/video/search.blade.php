@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-4">
        <h5 style="color:#fff;">Busqueda: {{ $search }}</h5>
    </div>
    <div class="col-md-10" style="background-color: #fff; border-radius:15px; margin-bottom:15px; padding:10px;">
        <form action="{{ url('/buscar/'.$search) }}" method="GET" class="col-md-3 pull-right">
            <label for="filter">Ordenar</label>
            <select name="filter" id="" class="form-control">
                <option value="new">Mas Nuevos Primeros</option>
                <option value="old">Mas Antiguos</option>
                <option value="alfa">A-Z</option>
            </select>
            <input style="margin-top:10px;" type="submit" class="btn btn-primary  btn-sm col-md-4" value="Ordenar">
        </form>
    </div>
    <div class="clearfix"></div>
    @include('video.videosList')
</div>
@endsection