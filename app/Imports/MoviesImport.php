<?php

namespace App\Imports;

use App\Movie;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class MoviesImport implements ToModel, WithCustomCsvSettings
{
    public function model(array $row)
    {
        return new Movie([
            'movie_id' => $row[0],
            'title' => $row[1],
            'genres' => $row[2]
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'input_encoding' => 'UTF-8'
        ];
    }
}
