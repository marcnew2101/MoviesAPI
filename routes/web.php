<?php


Route::get('/', function () {return view('welcome');});
Route::get('/movies', 'MoviesController@show');                         // show all movies
Route::get('/movies/id/{id}', 'MoviesController@showById');             // show single movie by id
Route::get('/movies/title/{title}', 'MoviesController@showByTitle');    // show single movie by title
Route::get('/movies/genre/{genre}', 'MoviesController@showByGenre');    // show all movies by genre
Route::get('/movies/year/{year}', 'MoviesController@showByYear');       // show all movies by year
Route::post('/movies/create', 'MoviesController@create');               // create new movie
Route::delete('movies/remove', 'MoviesController@remove');              // delete movie
//Route::patch('movies/edit', 'MoviesController@edit');                   // edit movie