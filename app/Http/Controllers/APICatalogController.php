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
    $m->rented = true;
    $m->save();
    return response()->json( ['error' => false, 'msg' => 'La película se ha marcado como alquilada' ] );
  }
  //quitar de alquilado
  public function putReturn($id) {
    $m = Movie::findOrFail( $id );
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
    $movie = Movie::create($request->all());
    return response()->json($movie, 201);
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
    return response()->json(Movie::where('id', $id)->get());
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
    $movie = Movie::find($id);
    $movie->update($request->all());

    return response()->json($movie, 200);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $movie = Movie::find($id);
    $movie->delete();
    return response()->json($movie, 200);

  }
  // ============= END API =============
}
