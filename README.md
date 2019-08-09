# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone git@github.com:marcnew2101/MoviesAPI.git

Switch to the repo folder

    cd MoviesAPI

Install all the dependencies using composer

    composer install

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## Folders

- `app` - Contains all the Eloquent models
- `app/Http/Controllers/MoviesController` - Contains all the api controllers
- `config` - Contains all the application configuration files
- `routes` - Contains all the api routes
- `storage` - Contains the necessary csv file for data import

## Database

This application uses a CSV file for importing/exporting data to/from the controller. The file (movies.csv) is located in /storage/app.

## Authentication

No authorization necessary for viewing and testing the API. CSRF checking has been disabled for movies/create

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/movies

### Endpoints
| Endpoints            | Description                                   |
|----------------------|-----------------------------------------------|
| /movies              | get all movies		                           |
| /movies/genre/       | get movies by genre                           |
| /movies/year/        | get movies by year                            |
| /movies/id/          | get movie by id                               |
| /movies/title/       | get movies by title search                    |
| /movies/create       | create new movie                              |
| /movies/remove       | delete movie                                  |

### Endpoint Examples

##### /movies/genre

http://localhost:8000/movies/genre/Action

##### /movies/title

http://localhost:8000/movies/title/American

##### /movies/year

http://localhost:8000/movies/year/1994

##### /movies/create

http://localhost:8000/movies/create

| key               | value                                |
|-------------------|--------------------------------------|
| title             | The 6th Day		                   |
| year              | 2000                                 |
| genre             | Action, Mystery, Sci-Fi, Thriller    |

##### /movies/remove

http://localhost:8000/movies/remove

| key               | value                 |
|-------------------|-----------------------|
| id                | 1		                |

## To Do

- edit existing movie
- check if movie already exists in database
- apply validation to title and year
- validate categories and comma separated values in genre
- fix utf encoding and replacing invalid characters from original csv data