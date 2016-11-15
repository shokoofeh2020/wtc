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

Route::get('/', function () {
    return view('landing');
});

Route::get('/ings','semanticController@searchIngs');

//search Foods containing ingredients
Route::post('/search',[
    'as' => 'searchFood',
    'uses' => 'semanticController@searchFood'
]);

//search ingredients
Route::post('/searchh',[
    'as' => 'searchIngs',
    'uses' => 'semanticController@searchIngs'
]);
