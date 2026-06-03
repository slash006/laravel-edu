<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/about', function () {
    return view('about');
});

/*Route::get('/contact', function () {
    return view('contact');
});*/

Route::view('contact', 'contact', [
    'title' => request('title'),
    'tasks' => [
        'sample',
        'task',
        'here'
    ]
]);


