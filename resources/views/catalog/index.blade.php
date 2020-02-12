@extends('layouts.master')

@section('content')
  <h1 class="mb-2 mt-1">{{($q ?? '')?'Resultados: ':''}}{{$q ?? '' ?? ''}}</h1>

  <div class="row">
  <?php
  // para añadir a la tabla pivot
  //$user->movies()->attach(App\Movie::findOrFail(1));
  // para quitar de la tabla pivot
  //$user->movies()->detach(App\Movie::findOrFail(1));
   ?>
  @foreach( $arrayPeliculas as $key => $pelicula )
    <div class="col-xs-6 col-sm-4 col-md-3 text-center">

        <a href="{{ url('/catalog/show/' . $pelicula->id ) }}">
            <img src="{{$pelicula->poster}}" style="height:200px"/>
            <h4 style="min-height:45px;margin:5px 0 10px 0">
                {{$pelicula->title}}
            </h4>
        </a>

    </div>
  @endforeach
  </div>

@stop
