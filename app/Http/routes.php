<?php

Route::get('/', function(){
    return view('index');
});

Route::auth();

Route::get('log', 'Auth\AuthController@log');

Route::resource('dream', 'DreamController', ['only' => ['index', 'store', 'update', 'destroy']]);




