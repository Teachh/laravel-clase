<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Review;
use Notify;

class CatalogController extends Controller
{
   public function getIndex(){
    return view('catalog.index',array('arrayPeliculas'=>Movie::all()));
  }
  public function getShow($id){
    $pelicula = Movie::findOrFail($id);
    $review = Review::where('movie_id',$id)->orderby('created_at','DESC')->paginate(3);
    return view('catalog.show',compact('pelicula','review'));
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
    return redirect('/catalog/show/'.$id);
  }
  public function putReturn($id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->rented = false;
    $pelicula->save();
    Notify::success('Se ha devuelto correctamente')->delay(2000);
    return redirect('/catalog/show/'.$id);
  }
  public function deleteMovie($id){
    $pelicula = Movie::findOrFail($id);
    $pelicula->delete();
    Notify::success('Has borrado la película con exito')->delay(2000);
    return redirect('/catalog');
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
    $movie->category_id = request('category');
    $movie->trailer = request('trailer');
    //guardarlo en la base
    $movie->save();
    Notify::success('Se ha creado correctamente')->delay(2000);
    return redirect('/catalog');
  }
  public function putEdit(Request $request, $id){
    //modificar
    $movie = Movie::findOrFail($id);
    //cargar parametros
    $movie->title = request('title');
    $movie->year = request('year');
    $movie->director = request('director');
    $movie->poster = request('poster');
    $movie->synopsis = request('synopsis');
    $movie->category_id = request('category');
    $movie->trailer = request('trailer');
    $movie->save();

    //Movie::findOrFail($id)->update($request->all());
    Notify::success('Se ha editado correctamente')->delay(2000);
    return redirect('/catalog/show/'.$id);
  }

  public function postComment(Request $request, $id){
      $user = auth()->user();
      $review = new Review();
      $review->title = request('title');
      $review->stars = request('stars');
      $review->review = request('review');
      $review->movie_id = $id;
      $review->user_id = $user->id;
      $review->save();
      Notify::success('Se ha editado publicado correctamente')->delay(2000);
      return redirect('/catalog/show/'.$id);
  }

  public function searcher(Request $request){
    $q = $request->input('q');
    $arrayPeliculas = Movie::where('title', 'LIKE', '%' . $q . '%')
                              ->orWhere('director', 'LIKE', '%' . $q . '%')
                              ->get();
    return view('catalog.index', compact('arrayPeliculas'));
  }
  // FAVORITOS
  public function favIndex(){
    $favMovies = auth()->user()->movies;
    return view('catalog.fav', compact('favMovies'));
  }
  // quitar de favoritos
  public function favDel($id){
    auth()->user()->movies()->detach(Movie::findOrFail($id));
    return redirect('/catalog/show/'.$id);
  }
  // añadir a favoritos
  public function favAdd($id){
    auth()->user()->movies()->attach(Movie::findOrFail($id));
    return redirect('/catalog/show/'.$id);
  }

  // ranking
  public function ranking(){
    $allMovies = Movie::all();
    $ranking = [];
    foreach ($allMovies as $mov => $value) {
      $ranking[$value->id] = Review::where('movie_id',$value->id)->avg('stars');
    }
    // ordenar
    arsort($ranking);
    return view('catalog.ranking', compact('ranking'));
  }
}
