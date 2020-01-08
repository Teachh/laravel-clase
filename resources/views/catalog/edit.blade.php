@extends('layouts.master')

@section('content')

<div class="row" style="margin-top:40px">
    <div class="offset-md-3 col-md-6">
        <div class="card">
            <div class="card-header text-center">
                Modificar película
            </div>
            <div class="card-body" style="padding:30px">

                {{-- TODO: Abrir el formulario e indicar el método POST --}}
                <form method="post">
                    {{method_field('PUT')}}
                    {{-- TODO: Protección contra CSRF --}}
                    @csrf
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" name="title" value="{{ $pelicula->title }}" id="title" class="form-control">
                    </div>

                    <div class="form-group">
                        {{-- TODO: Completa el input para el año --}}
                        <label for="title">Año</label>
                        <input type="text" name="year" value="{{ $pelicula->year }}" id="year" class="form-control">
                    </div>

                    <div class="form-group">
                        {{-- TODO: Completa el input para el director --}}
                        <label for="title">Director</label>
                        <input type="text" name="director" value="{{ $pelicula->director }}" id="director" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="title">Poster</label>
                        <input type="text" name="poster" value="{{ $pelicula->poster }}" id="poster" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="synopsis">Resumen</label>
                        <textarea name="synopsis" id="synopsis" class="form-control" rows="3">{{ $pelicula->synopsis }}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                            Modificar película
                        </button>
                    </div>

                    {{-- TODO: Cerrar formulario --}}
                </form>

            </div>
        </div>
    </div>
</div>


@stop
