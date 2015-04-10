<?php

Route::get('/', function(){
    return view('index');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::resource('dream', 'DreamController', ['only' => ['index', 'store', 'update', 'destroy']]);




