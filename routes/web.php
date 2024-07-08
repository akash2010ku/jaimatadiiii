<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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





$router->post('/admin/createUser',"UserController@createUser");
$router->get('/admin/userList',"UserController@userList");
$router->put('/admin/updateUser',"UserController@updateUser");
$router->delete('/admin/deleteUser',"UserController@deleteUser");

$router->post('/admin/createBook',"BooksController@createBook");
$router->get('/admin/bookList',"BooksController@bookList");


$router->post('/registration',"RegistrationController@registration");
