@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img class="w-100" src="{{$pelicula->poster}}" alt="">


    </div>
    <div class="col-sm-8">
        <h2>{{$pelicula->title}}</h2>
        <h4>Año: {{$pelicula->year}}</h4>
        <h4>Director: {{$pelicula->director}}</h4>
        <p><span style="font-weight:bold">Resumen: </span>{{$pelicula->synopsis}}</p>
        <br>
        @if (!$pelicula->rented)
        <p><span style="font-weight:bold">Estado:</span>La película se puede alquilar</p>
        @else
        <p><span style="font-weight:bold">Estado:</span>La película actualmente está alquilada</p>
        @endif

        <div class="d-flex">
            @if (!$pelicula->rented)
            <form action="{{action('CatalogController@putRent', $pelicula->id)}}" method="POST" style="display:inline">
              @csrf
              @method('put')
                <a href="{{url('/catalog/rent/'.$pelicula->id)}}"><button type="submit" class="btn btn-primary ml-1">Alquilar película</button></a>
            </form>
            @else
            <form action="{{action('CatalogController@putReturn', $pelicula->id)}}" method="POST" style="display:inline">
              @csrf
              @method('put')
                <a href="{{url('/catalog/return/'.$pelicula->id)}}"><button type="submit" class="btn btn-danger ml-1">Devolver película</button></a>
            </form>
            @endif
            <a href="{{url('/catalog/edit/'.$pelicula->id)}}"><button type="submit" class="btn btn-warning ml-1"> <i class="fas fa-pen"></i> Editar película</button></a>
            <a href="{{url('/catalog')}}"><button type="submit" class="btn btn-light ml-1"> <i class="fas fa-angle-left"></i> Volver al listado</button></a>
            <form action="{{action('CatalogController@deleteMovie', $pelicula->id)}}" method="POST" style="display:inline">
              @csrf
              @method('delete')
                <a href="{{url('/catalog/delete/'.$pelicula->id)}}"><button type="submit" class="btn btn-danger">Borrar película</button></a>
            </form>

        </div>
    </div>
</div>

@stop
