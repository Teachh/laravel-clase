<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/login',function(){
//   return view('auth.login');
// });
// Route::get('/logout',function(){
//   return "Logout usuario";
// });
// Route::get('/','HomeController@getHome');
Route::get('/', 'HomeController@getHome')->name('home');
Route::get('/catalog','CatalogController@getIndex')->middleware('auth');
Route::get('/catalog/show/{id}','CatalogController@getShow')->middleware('auth');
Route::get('/catalog/create','CatalogController@getCreate')->middleware('auth');
Route::get('/catalog/edit/{id}','CatalogController@getEdit')->middleware('auth');
Route::put('/catalog/edit/{id}','CatalogController@putEdit')->middleware('auth');
Route::post('/catalog/create','CatalogController@postCreate')->middleware('auth');
Route::put('/catalog/rent/{id}','CatalogController@putRent')->middleware('auth');
Route::put('/catalog/return/{id}','CatalogController@putReturn')->middleware('auth');
Route::delete('/catalog/delete/{id}','CatalogController@deleteMovie')->middleware('auth');
Route::post('/catalog/comment/{id}','CatalogController@postComment')->middleware('auth');
Route::get('/catalog','CatalogController@searcher')->middleware('auth');
Route::resource('category','CategoryController')->middleware('auth');
// favoritos
Route::get('/favoritos','CatalogController@favIndex')->middleware('auth');
Route::put('/favoritos/del/{id}','CatalogController@favDel')->middleware('auth');
Route::put('/favoritos/add/{id}','CatalogController@favAdd')->middleware('auth');
// ranking
Route::get('/ranking','CatalogController@ranking')->middleware('auth');

Auth::routes();
