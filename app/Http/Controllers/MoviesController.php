<?php

namespace App\Http\Controllers;

use App\Imports\MoviesImport;
use App\Exports\MoviesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function showAll() 
    {
        $collection = Excel::toCollection(                                          // import movies.csv as collection
            new MoviesImport, 
            storage_path('/app/movies.csv')
        );

        $newCollection = $collection;                                               // get entire movie collection
        $data = [];                                                                 // new empty array for final data
        foreach ($newCollection as $item) {                                         // iterate over initial collection
            foreach ($item as $items) {                                             // iterate over nested items in collection
                if ($items[0] != 'movie id' AND $items[0] != null) {                // skip header from csv import and null id
                    $movie_array = preg_split("/\s(?=[^\(\s]*\(\d)/", $items[1]);   // split movie year and movie title, create new array
                    $movie_year = preg_replace('/[()]/', '', $movie_array[1]);      // remove parenthesis from year, create new $var for movie year
                    $movie_title = $movie_array[0];                                 // create new $var for movie title
                    $genre_array = preg_split("/[|]/", $items[2]);                  // split movie genres, create new array  
                    $data[$items[0]] = [                                            // push movie id to parent of $data array, set movie title/year/genres to children
                        $movie_title, 
                        $movie_year, 
                        $genre_array
                    ];
                }
            }
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE);                          // return json 
    }


    public function showOneById($id) 
    {
        $collection = Excel::toCollection(                                          // import movies.csv as collection
            new MoviesImport, 
            storage_path('/app/movies.csv')
        );

        $newCollection = $collection;                                               // get entire movie collection
        $data = [];                                                                 // new empty array for final data
        foreach ($newCollection as $item) {                                         // iterate over initial collection
            foreach ($item as $items) {                                             // iterate over nested items in collection
                if ($items[0] != 'movie id' AND $items[0] != null) {                // skip header from csv import and null id
                    $movie_array = preg_split("/\s(?=[^\(\s]*\(\d)/", $items[1]);   // split movie year and movie title, create new array
                    $movie_year = preg_replace('/[()]/', '', $movie_array[1]);      // remove parenthesis from year, create new $var for movie year
                    $movie_title = $movie_array[0];                                 // create new $var for movie title
                    $genre_array = preg_split("/[|]/", $items[2]);                  // split movie genres, create new array
                    $data[$items[0]] = [                                            // push movie id to parent of $data array, set movie title/year/genres to children
                        $movie_title,
                        $movie_year,
                        $genre_array
                    ];
                }
            }
        }

        return json_encode($data[$id], JSON_UNESCAPED_UNICODE);                     // return json with id filter from route
    }


    public function showOneByTitle($title) 
    {
        $collection = Excel::toCollection(                                          // import movies.csv as collection
            new MoviesImport, 
            storage_path('/app/movies.csv')
        );

        $newCollection = $collection;                                               // get entire movie collection
        $data = [];                                                                 // new empty array for final data
        foreach ($newCollection as $item) {                                         // iterate over initial collection
            foreach ($item as $items) {                                             // iterate over nested items in collection
                if ($items[0] != 'movie id' AND $items[0] != null) {                // skip header from csv import and null id
                    $movie_array = preg_split("/\s(?=[^\(\s]*\(\d)/", $items[1]);   // split movie year and movie title, create new array
                    $movie_year = preg_replace('/[()]/', '', $movie_array[1]);      // remove parenthesis from year, create new $var for movie year
                    $movie_title = $movie_array[0];                                 // create new $var for movie title
                    $genre_array = preg_split("/[|]/", $items[2]);                  // split movie genres, create new array
                    if (strpos($movie_title, $title) !== false) {                   // *filter title from route*
                        $data[$items[0]] = [                                        // push movie id to parent of $data array, set movie title/year/genres to children
                            $movie_title,
                            $movie_year,
                            $genre_array
                        ];
                    }
                }
            }
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE);                          // return json
    }


    public function showAllByGenre($genre) 
    {
        $collection = Excel::toCollection(                                          // import movies.csv as collection
            new MoviesImport, 
            storage_path('/app/movies.csv')
        );

        $newCollection = $collection;                                               // get entire movie collection
        $data = [];                                                                 // new empty array for final data
        foreach ($newCollection as $item) {                                         // iterate over initial collection
            foreach ($item as $items) {                                             // iterate over nested items in collection
                if ($items[0] != 'movie id' AND $items[0] != null) {                // skip header from csv import and null id
                    $movie_array = preg_split("/\s(?=[^\(\s]*\(\d)/", $items[1]);   // split movie year and movie title, create new array
                    $movie_year = preg_replace('/[()]/', '', $movie_array[1]);      // remove parenthesis from year, create new $var for movie year
                    $movie_title = $movie_array[0];                                 // create new $var for movie title
                    $genre_array = preg_split("/[|]/", $items[2]);                  // split movie genres, create new array
                    if (in_array($genre, $genre_array)) {                           // *filter genre from route*
                        $data[$items[0]] = [                                        // push movie id to parent of $data array, set movie title/year/genres to children
                            $movie_title,
                            $movie_year,
                            $genre_array
                        ];
                    }
                }
            }
        }         

        return json_encode($data, JSON_UNESCAPED_UNICODE);                          // return json 
    }


    public function showAllByYear($year)
    {
        $collection = Excel::toCollection(                                          // import movies.csv as collection
            new MoviesImport, 
            storage_path('/app/movies.csv')
        );

        $newCollection = $collection;                                               // get entire movie collection
        $data = [];                                                                 // new empty array for final data
        foreach ($newCollection as $item) {                                         // iterate over initial collection
            foreach ($item as $items) {                                             // iterate over nested items in collection
                if ($items[0] != 'movie id' AND $items[0] != null) {                // skip header from csv import and null id
                    $movie_array = preg_split('/\s(?=[^\(\s]*\(\d)/', $items[1]);   // split movie year and movie title, create new array
                    $movie_year = preg_replace('/[()]/', '', $movie_array[1]);      // remove parenthesis from year, create new $var for movie year
                    $movie_title = $movie_array[0];                                 // create new $var for movie title
                    $genre_array = preg_split('/[|]/', $items[2]);                  // split movie genres, create new array
                    if ($year == $movie_year) {                                     // *filter year from route*
                        $data[$items[0]] = [                                        // push movie id to parent of $data array, set movie title/year/genres to children
                            $movie_title,
                            $movie_year,
                            $genre_array
                        ];
                    }
                }
            }
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE);                          // return json
    }


    public function create() 
    {
        $movieData = request()->validate([                                          // request data from post method
            'title' => 'required',
            'year' => 'required',
            'genre' => 'required'
        ]);

        $old_array = Excel::toArray(                                                // import movies.csv as array
            new MoviesImport, 
            storage_path('/app/movies.csv')
        );

        $last_id = end($old_array[0]);                                              // get id of last movie in csv import
        $new_id = $last_id[0] + 1;                                                  // add one to id found in last_id
        $year_string = strval($movieData['year']);                                  // ensure year is in string format
        $movie_year = ' (' . $year_string . ')';                                    // add parentheses around year_string
        $movie_title = $movieData['title'] . $movie_year;                           // combine movie_title and movie_year to single string
        $comma_find = array(','=>'|');                                              // array to find comma values in genre
        $comma_replace = strtr($movieData['genre'], $comma_find);                   // replace commas in genre with pipe "|"
        $movie_genre = preg_replace('/\s+/', '', $comma_replace);                   // remove whitespace from genre
        $new_array = array($new_id, $movie_title, $movie_genre);                    // create new array using newly added movie

        array_push($old_array, $new_array);                                         // push new movie to end of original array

        return Excel::store(new MoviesExport($old_array), 'movies.csv');            // save csv file with new movie now added
    }
}
