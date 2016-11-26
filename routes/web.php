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

Route::get('/fooddetail','semanticController@Fooddet');

Route::get('/con','semanticController@convert');

Route::get('/foodistaa',function(){
	return view('foodista');
});

//search Foods containing ingredients
Route::post('/search',[
    'as' => 'searchFood',
    'uses' => 'semanticController@searchFood'
]);

//search Foods containing ingredients
Route::post('/searchF',[
		'as' => 'searchF',
		'uses' => 'semanticController@foodista3'
]);

//search ingredients
Route::post('/searchh',[
    'as' => 'searchIngs',
    'uses' => 'semanticController@searchIngs'
]);
