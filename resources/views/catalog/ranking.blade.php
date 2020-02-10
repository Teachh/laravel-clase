@extends('layouts.master')

@section('content')
  <h2>RÁNKING</h2>
  <div class="row">
    @php
       $cnt = 1;
    @endphp
    @foreach( $ranking as $movie => $key )
      @php
        $pelicula = App\Movie::where('id',$movie)->get();
      @endphp
      <div class="col-xs-12 col-sm-6 col-md-6 text-center mt-3">
            <div class="row">
              <div class="col-4">
                <a href="{{ url('/catalog/show/' . $pelicula[0]->id ) }}">
                  <img src="{{$pelicula[0]->poster}}" class="w-100"/>
                </a>
              </div>
              <div class="col-8">
                <a href="{{ url('/catalog/show/' . $pelicula[0]->id ) }}">
                  <h4 style="min-height:45px;margin:5px 0 10px 0">
                      {{$cnt}}. {{$pelicula[0]->title}}
                      <?php $cnt++; ?>
                  </h4>
                </a>
                <p> {{($key != null)?number_format($key,2,',',' ').'/5':'No hay votos aún'}}
                  @php
                    if($key != null){
                      @endphp
                      <i class="fa fa-star" aria-hidden="true"></i>
                      @php
                    }
                  @endphp
                </p>
                <p>Director: {{$pelicula[0]->director}}</p>
                <p>Categoria: {{$pelicula[0]->category->title}}</p>
              </div>
            </div>

      </div>

    @endforeach
  </div>
@stop
