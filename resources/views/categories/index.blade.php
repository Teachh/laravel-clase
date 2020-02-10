@extends('layouts.master')

@section('content')
<h2 class="mb-3">Lista de categorias</h2>
<a href="{{url('/category/create')}}"><button type="submit" class="btn btn-primary ml-1">Crear categoría</button></a>
<table id="cattable" class="w-100">
  <thead>
    <tr>
      <td>ID</td>
      <td>Nombre</td>
      <td>Descripción</td>
      <td>Adulto</td>
      <td>Acciones</td>
    </tr>
  </thead>
  <tbody>
    @foreach ($categories as $cat)
      <tr>
        <td>{{$cat->id}}</td>
        <td>{{$cat->title}}</td>
        <td>{{$cat->description}}</td>
        <td>{{($cat->adult)?'SI':'NO'}}</td>
        <td>
          <a href="{{url('/category/'.$cat->id)}}"><button type="button" class="btn btn-info ml-1">Mostrar</button></a>
          <a href="{{url('/category/'.$cat->id.'/edit')}}"><button type="button" class="btn btn-warning ml-1">Editar</button></a>
          <form action="{{action('CategoryController@destroy', $cat->id)}}" method="post" style="display: inline">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger ml-1">Eliminar</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

@stop
