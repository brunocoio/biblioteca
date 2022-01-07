<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// /contato/{id?} o ? define não obrigatório
// Route::get('/contato/{id?}', function($id = null) {
//     return"Contato id = $id";
// });

// POST
// Route::post('/contato', function() {
//     //var_dump($_POST);
//     dd($_POST);
//     return"Contato POST";
// });

// PUT (para edição)
// Route::put('/contato', function() {
//     return"Contato PUT";
// });

//GET
Route::get('/', function () {
    return view('welcome');
});

//com controller
Route::get('/contato/{id?}', ['uses' =>'ContatoController@index']);
Route::post('/contato', ['uses' =>'ContatoController@criar']);
Route::put('/contato', ['uses' =>'ContatoController@editar']);
