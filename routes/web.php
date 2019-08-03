<?php


Route::get('/', function () {return view('welcome');});
Route::get('movies', 'MoviesController@showAll');                       // show all movies
Route::get('movies/id/{id}', 'MoviesController@showOneById');           // show single movie by id
Route::get('movies/title/{id}', 'MoviesController@showOneByTitle');     // show single movie by title
Route::get('movies/genre/{genre}', 'MoviesController@showAllByGenre');  // show all movies by genre
Route::get('movies/year/{year}', 'MoviesController@showAllByYear');     // show all movies by year
//Route::get('movies/create', 'MoviesController@create');                 // create new movie
//Route::get('movies/update', 'MoviesController@update');                 // edit movie
//Route::get('movies/remove', 'MoviesController@delete');                 // delete movie