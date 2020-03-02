@extends('layouts.master')

@section('content')

<div class="row">

    <div class="col-sm-4">

        <img class="w-100 mb-5" src="{{$pelicula->poster}}" alt="">
        <form id="comForm" action="{{action('CatalogController@postComment', $pelicula->id)}}" method="post">
          @csrf
          <a>Enviar comentario:</a>
          <input class="mb-3 mt-2 w-100" type="text" name="title" placeholder="Resumen del comentario" required>
          <a>Valoración:</a>
          <select class="mb-3 mt-2 w-100" name="stars">
            <option value="1">1 estrella</option>
            <option value="2">2 estrella</option>
            <option value="3">3 estrella</option>
            <option value="4">4 estrella</option>
            <option value="5">5 estrella</option>
          </select>
          <textarea class="w-100" name="review" rows="5" cols="80" placeholder="Dinos tu opinión" required></textarea>
          <button type="submit" class="btn btn-primary ml-1">Valorar</button>
        </form>

    </div>
    <div class="col-sm-8">
        <h2>{{$pelicula->title}}</h2>
        <h4>Año: {{$pelicula->year}}</h4>
        <h4>Director: {{$pelicula->director}}</h4>
        <h4>Categoría: {{$pelicula->category->title}}</h4>
        <p><span style="font-weight:bold">Resumen: </span>{{$pelicula->synopsis}}</p>
        <h4>Trailer</h4>
        <iframe width="100%" height="400rem"
        src="{{$pelicula->trailer}}">
        </iframe>
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

            @if (auth()->user()->movies->find($pelicula->id))
              <form action="{{action('CatalogController@favDel', $pelicula->id)}}" method="POST" style="display:inline">
                @csrf
                @method('put')
                  <a href="{{url('/favoritos/del'.$pelicula->id)}}"><button type="submit" class="btn btn btn-outline-danger ml-1"> <i class="fas fa-heart-broken"></i> Quitar de favoritos</button></a>
              </form>
            @else
              <form action="{{action('CatalogController@favAdd', $pelicula->id)}}" method="POST" style="display:inline">
                @csrf
                @method('put')
                  <a href="{{url('/favoritos/add'.$pelicula->id)}}"><button type="submit" class="btn btn btn-outline-danger ml-1"> <i class="fas fa-heart"></i> Añadir a favoritos</button></a>
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
        <h3 class="mt-2 mt-md-5">COMENTARIOS</h3>
          @foreach ($review as $rev)
            <div class="comentarios mb-3">
              <h5>{{$rev->title}}</h5>
              <p>{{$rev->stars}} estrellas</p>
              <p>{{$rev->review}}</p>
              <p class="fechas">--{{$rev->created_at}} - {{$rev->user->name}}</p>
            </div>
          @endforeach
          <div class="col-12 d-flex justify-content-center orders-pagination">{{ $review->links() }}</div>

    </div>
</div>

@stop
