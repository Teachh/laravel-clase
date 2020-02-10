@extends('layouts.master')

@section('content')
  <h2>Películas favoritas</h2>
  <div class="row">
    @foreach( $favMovies as $key => $pelicula )
      <div class="col-xs-6 col-sm-4 col-md-3 text-center mt-3">
          <a href="{{ url('/catalog/show/' . $pelicula->id ) }}">
            <div class="container">
              <img src="{{$pelicula->poster}}" style="height:200px"/>
              <i class="fas fa-heart big-icon" style="position:inherit;right: 16px;top:-80px;color: red;font-size: 2rem;"></i>
            </div>
              <h4 style="min-height:45px;margin:5px 0 10px 0">
                  {{$pelicula->title}}
              </h4>
          </a>
      </div>
    @endforeach
  </div>
@stop
