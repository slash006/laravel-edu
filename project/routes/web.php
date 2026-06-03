<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

use App\Models\Idea;

Route::get('/', function () {

//    $ideas = session()->get('ideas', []);
//    $ideas = DB::table('ideas')->get();
//    $ideas = Idea::all();


    // TODO: check Idea::query
    $condition = request()->query('state', 'pending');
    $ideas = Idea::where('state', $condition)->get();
//    dd($ideas);

    return view('ideas', [
        'ideas' => $ideas
    ]);
});

Route::post('/ideas', function () {

    $idea = request()->idea;

  /*  DB::table('ideas')->insert([
        'description' => $idea,
        'state' => 'pending'
    ]);*/


    Idea::create(
        [
            'description' => $idea,
            'state' => 'pending'
        ]
    );



//    session()->push('ideas', $idea);
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


