<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('ideas', [
        'ideas' => session()->get('ideas', [])
    ]);
});

Route::post('/ideas', function () {

    $idea = request()->idea;

    session()->push('ideas', $idea);
    return redirect('/');

//    dd(request("idea"));
});

Route::get('/delete-ideas', function () {

    session()->forget('ideas'); // forget or delete?
    return redirect('/');
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


