<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use Notify;

class CatalogController extends Controller
{
   public function getIndex(){
    return view('catalog.index',array('arrayPeliculas'=>Movie::all()));
  }
  public function getShow($id){
    $pelicula = Movie::findOrFail($id);
    return view('catalog.show',compact('pelicula'));
  }
  public function getCreate(){
    return view('catalog.create');
  }
  public function getEdit($id){
    $pelicula = Movie::findOrFail($id);
    return view('catalog.edit',compact('pelicula'));
  }
  //ACTUAL
  public function putRent($id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->rented = true;
    $pelicula->save();
    Notify::success('Se ha alquilado correctamente')->delay(2000);
    return view('catalog.show',compact('pelicula'));
  }
  public function putReturn($id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->rented = false;
    $pelicula->save();
    Notify::success('Se ha devuelto correctamente')->delay(2000);
    return view('catalog.show',compact('pelicula'));
  }
  public function deleteMovie($id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->delete();
    Notify::success('Has borrado la película con exito')->delay(2000);
    return view('catalog.index',array('arrayPeliculas'=>Movie::all()));
  }
  //ACTUAL
  public function postCreate(Request $request){
    //declaracion
    $movie = new Movie();
    //cargar parametros
    $movie->title = request('title');
    $movie->year = request('year');
    $movie->director = request('director');
    $movie->poster = request('poster');
    $movie->synopsis = request('synopsis');
    //guardarlo en la base
    $movie->save();
    Notify::success('Se ha creado correctamente')->delay(2000);
    return redirect('/catalog');
  }
  public function putEdit(Request $request, $id){
    //modificar
    Movie::findOrFail($id)->update($request->all());
    Notify::success('Se ha editado correctamente')->delay(2000);
    return redirect('/catalog/show/'.$id);
  }
}
