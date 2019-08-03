<?php

namespace App\Http\Controllers;

use App\Imports\MoviesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function showAll() 
    {
        $collection = Excel::toCollection(                                      // import movies.csv as collection
            new MoviesImport, 
            storage_path('movies.csv')
        );

        $newCollection = $collection;                                           // get entire movie collection
        $data = [];                                                             // new empty array for final data
        foreach ($newCollection as $item) {                                     // iterate over initial collection
            unset($item[0]);                                                    // remove header data from csv import
            unset($item[1]);                                                    // remove empty data from csv import
            foreach ($item as $items) {                                         // iterate over nested items in collection
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

        return json_encode($data, JSON_UNESCAPED_UNICODE);                      // return json 
    }


    public function showOneById($id) 
    {
        $collection = Excel::toCollection(                                      // import movies.csv as collection
            new MoviesImport, 
            storage_path('movies.csv')
        );

        $newCollection = $collection;                                           // get entire movie collection
        $data = [];                                                             // new empty array for final data
        foreach ($newCollection as $item) {                                     // iterate over initial collection
            unset($item[0]);                                                    // remove header data from csv import
            unset($item[1]);                                                    // remove empty data from csv import
            foreach ($item as $items) {                                         // iterate over nested items in collection
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

        return json_encode($data[$id], JSON_UNESCAPED_UNICODE);                  // return json with id filter from route
    }


    public function showAllByGenre($genre) 
    {
        $collection = Excel::toCollection(                                      // import movies.csv as collection
            new MoviesImport, 
            storage_path('movies.csv')
        );

        $newCollection = $collection;                                           // get entire movie collection
        $data = [];                                                             // new empty array for final data
        foreach ($newCollection as $item) {                                     // iterate over initial collection
            unset($item[0]);                                                    // remove header data from csv import
            unset($item[1]);                                                    // remove empty data from csv import
            foreach ($item as $items) {                                         // iterate over nested items in collection
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

        return json_encode($data, JSON_UNESCAPED_UNICODE);                      // return json 
    }


    public function showAllByYear($year)
    {
        $collection = Excel::toCollection(                                      // import movies.csv as collection
            new MoviesImport, 
            storage_path('movies.csv')
        );

        $newCollection = $collection;                                           // get entire movie collection
        $data = [];                                                             // new empty array for final data
        foreach ($newCollection as $item) {                                     // iterate over initial collection
            unset($item[0]);                                                    // remove header data from csv import
            unset($item[1]);                                                    // remove empty data from csv import
            foreach ($item as $items) {                                         // iterate over nested items in collection
                $movie_array = preg_split("/\s(?=[^\(\s]*\(\d)/", $items[1]);   // split movie year and movie title, create new array
                $movie_year = preg_replace('/[()]/', '', $movie_array[1]);      // remove parenthesis from year, create new $var for movie year
                $movie_title = $movie_array[0];                                 // create new $var for movie title
                $genre_array = preg_split("/[|]/", $items[2]);                  // split movie genres, create new array
                if ($year == $movie_year) {                                     // *filter year from route*
                    $data[$items[0]] = [                                        // push movie id to parent of $data array, set movie title/year/genres to children
                        $movie_title, 
                        $movie_year, 
                        $genre_array
                    ];
                }
            }
        }

        return json_encode($data, JSON_UNESCAPED_UNICODE);                      // return json
    }
}
