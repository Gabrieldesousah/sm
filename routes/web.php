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


Route::get('/', 'WelcomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'DashboardController@index');


//Users
Route::get('/users', 'UsersController@index');
Route::get('/editprofile/{name?}', 'UsersController@edit');
Route::get('/editpass/{name?}', 'UsersController@editpass');
Route::post('/updateprofile/{name?}', 'UsersController@updateProfile');
Route::post('/updatepass/{name?}', 'UsersController@updatePass');
Auth::routes();


//Contents
Route::get('/contents', 'ContentsController@index');
Route::get('/contents/{name}', 'ContentsController@show');
//Route::get('/selectInMass', 'ContentsController@selectInMass');
//Route::post('/contentsInMass', 'ContentsController@createInMass');

//Professors
//Route::get('/selectInMass', 'ProfessorsController@selectInMass');
//Route::post('/professorsInMass', 'ProfessorsController@createInMass');

//Materials
Route::get('/material/{material}', 'MaterialsController@show');
Route::get('/materials/share', 'MaterialsController@create');
Route::post('/materials/store', 'MaterialsController@store');

//Comments
Route::post('/comments/store', 'CommentsController@store');
Route::get('/comments/edit/{comment}', 'CommentsController@edit');
Route::post('/comments/update', 'CommentsController@update');
Route::get('/comments/destroy/{comment}', 'CommentsController@destroy');

//Search
Route::get('/search/key', 'SearchController@key');

//File
Route::get('/file/{material}', 'MaterialsController@show_file');
Route::get('/file/{material}/{file}', 'MaterialsController@show_file');


/*

### Optional Parameters

Occasionally you may need to specify a route parameter, but make the presence of that route parameter optional. You may do so by placing a `?` mark after the parameter name. Make sure to give the route's corresponding variable a default value:

    Route::get('user/{name?}', function ($name = null) {
        return $name;
    });

    Route::get('user/{name?}', function ($name = 'John') {
        return $name;
    });
*/