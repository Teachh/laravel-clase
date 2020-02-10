@extends('layouts.master')

@section('content')
  <div class="container">
    <h3 class="mt-2">Buscador</h3>
    <form action="{{ action('CatalogController@searcher')}}" method="GET" class="mb-4">
      <div class="row">
        <div class="col-12 col-md-10">
          <input class="form-control" type="text" name="q" required/>
        </div>
        <div class="col-12 col-md-2">
          <button type="submit" class="btn btn-primary mt-3 mt-sm-0">Buscar</button>
        </div>
      </div>
    </form>
  </div>
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
