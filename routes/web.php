<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('/key', function () {
    return str_random(32);
});
$router->group(['prefix' => '/api/v1'], function () use ($router) {

  $router->get('/books', ['uses' => 'BooksController@getAllBooks']);

  $router->get('/books/{id}', [
    'as' => 'book.get',
    'uses' => 'BooksController@getABook'
  ]);

  $router->post('/books', ['uses' => 'BooksController@createBook']);

  $router->put('/books/{id}', ['uses' => 'BooksController@update']);

});
