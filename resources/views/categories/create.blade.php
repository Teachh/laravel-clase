@extends('layouts.master')

@section('content')
  <div class="row" style="margin-top:40px">
      <div class="offset-md-3 col-md-6">
          <div class="card">
              <div class="card-header text-center">
                  Añadir categoría
              </div>
              <div class="card-body" style="padding:30px">

                  {{-- TODO: Abrir el formulario e indicar el método POST --}}
                  <form method="post" action="{{action('CategoryController@store')}}">
                      {{-- TODO: Protección contra CSRF --}}
                      @csrf

                      <div class="form-group">
                          <label for="title">Nombre</label>
                          <input type="text" name="title" id="title" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="synopsis">Descriptión</label>
                          <textarea name="description" id="description" class="form-control" required rows="3"></textarea>
                      </div>

                      <div class="form-group">
                          <label for="title">Adulta</label>
                          <select class="form-control" name="adult">
                            <option value="0">NO</option>
                            <option value="1">SI</option>
                          </select>
                      </div>

                      <div class="form-group text-center">
                          <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                              Añadir categoría
                          </button>
                      </div>

                      {{-- TODO: Cerrar formulario --}}
                  </form>

              </div>
          </div>
      </div>
  </div>
@stop
