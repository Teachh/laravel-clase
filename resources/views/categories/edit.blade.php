@extends('layouts.master')

@section('content')

  <div class="row" style="margin-top:40px">
      <div class="offset-md-3 col-md-6">
          <div class="card">
              <div class="card-header text-center">
                  Modificar categoría
              </div>
              <div class="card-body" style="padding:30px">
                  <form method="post" action="{{action('CategoryController@update', $categoria->id)}}">
                      @csrf
                      {{method_field('PUT')}}
                      <div class="form-group">
                          <label for="title">Nombre</label>
                          <input type="text" name="title" value="{{$categoria->title}}" id="title" class="form-control" required>
                      </div>

                      <div class="form-group">
                          <label for="synopsis">Descriptión</label>
                          <textarea name="description" id="description" class="form-control" required rows="3">{{$categoria->description}}</textarea>
                      </div>

                      <div class="form-group">
                          <label for="title">Adulta</label>
                          <select class="form-control" name="adult">
                            <option {{($categoria->adult)?'selected="selected"':''}} value="0">NO</option>
                            <option {{($categoria->adult)?'selected="selected"':''}} value="1">SI</option>
                          </select>
                      </div>

                      <div class="form-group text-center">
                          <button type="submit" class="btn btn-primary" style="padding:8px 100px;margin-top:25px;">
                              Modificar categoría
                          </button>
                      </div>
                  </form>

              </div>
          </div>
      </div>
  </div>

@stop
