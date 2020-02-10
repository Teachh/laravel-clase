@extends('layouts.master')

@section('content')
  <div class="mt-3">
      <h2>{{$categoria->title}}</h2>
      <p><span style="font-weight:bold">Descripción: </span>{{$categoria->description}}</p>
      @if (!$categoria->adult)
      <p><span style="font-weight:bold">Estado:</span>No es una categoría de adultos</p>
      @else
      <p><span style="font-weight:bold">Estado:</span>Es una categoría de adultos</p>
      @endif
      <a href="{{url('/category')}}"><button type="button" class="btn btn-primary ml-1 w-100">Atrás</button></a>

  </div>
@stop
