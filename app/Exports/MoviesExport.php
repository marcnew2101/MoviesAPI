<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class MoviesExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $movies;

    public function __construct(array $movies)
    {
        $this->movies = $movies;
    }

    public function array(): array
    {
        return $this->movies;
    }
}
