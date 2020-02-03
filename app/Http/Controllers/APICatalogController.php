<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
class APICatalogController extends Controller
{

  // =============   API   =============
  //poner en alquilado
 public function putRent($id) {
    $m = Movie::findOrFail( $id );
    if($m->rented == true){
      return 'Esta pelicula ya está alquilada';
    }
    $m->rented = true;
    $m->save();
    return response()->json( ['error' => false, 'msg' => 'La película se ha marcado como alquilada' ] );
  }
  //quitar de alquilado
  public function putReturn($id) {
    $m = Movie::findOrFail( $id );
    if($m->rented == false){
      return 'Esta pelicula ya está sin alquilar';
    }
    $m->rented = false;
    $m->save();
    return response()->json( ['error' => false, 'msg' => 'La película se ha marcado como no alquilada' ] );
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return response()->json(Movie::all());
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    if(!$request->has('title') || !$request->has('year') || !$request->has('director') || !$request->has('poster') || !$request->has('rented') || !$request->has('synopsis')){
      echo 'No se puede crear porque falta/n campos';
    }
    else{
      $movie = Movie::create($request->all());
      return response()->json($movie, 201);
    }


  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
   // cambiar email para el futuro
  public function show($id)
  {
    // te lo pongo asi porque con el find or fail me salta error normal
    $movie = Movie::where('id', $id)->get();
    if(sizeof($movie)){
      return response()->json($movie);
    }
    else{
      return 'El código no es correcto';
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    //$movie = Movie::findOrFail($id);
    // te lo pongo asi porque con el find or fail me salta error normal
    $movie = Movie::where('id', $id)->get();
    if(sizeof($movie)){
      $movie->update($request->all());
      return response()->json($movie, 200);
    }
    else{
      return 'El código no es correcto';
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // te lo pongo asi porque con el find or fail me salta error normal
    $movie = Movie::where('id', $id)->get();
    if(sizeof($movie)){
      Movie::where('id', $id)->delete();
      return response()->json('Borrada correctamente', 200);
    }
    else{
      return 'El código no es correcto';
    }

  }
  // ============= END API =============
}
