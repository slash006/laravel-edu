<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Idea;

// index
Route::get('/ideas', function () {

    //    $ideas = session()->get('ideas', []);
    //    $ideas = DB::table('ideas')->get();
    $ideas = Idea::all();

    // TODO: check Idea::query
    //    $condition = request()->query('state', 'pending');
    //    $ideas = Idea::where('state', $condition)->get();
    //    dd($ideas);

    return view('ideas.index', [ // ideas/index
        'ideas' => $ideas
    ]);
});


// create
Route::get('/ideas/create', function (Idea $idea) {

    return view('ideas.create', [
        'idea' => $idea,
        'state' => 'mew'
    ]);

});

// show
Route::get('/ideas/{idea}', function (Idea $idea) {

    return view('ideas.show', [
        'idea' => $idea
    ]);

});

// edit
Route::get('/ideas/{idea}/edit', function (Idea $idea) {

    return view('ideas.edit', [
        'idea' => $idea
    ]);

});

// update
Route::patch('/ideas/{idea}', function (Idea $idea) {

    $idea->update([
        'description' => request('description')
    ]);

    return redirect('/ideas/' . $idea->id);
});


// delete
Route::delete('/ideas/{idea}', function (Idea $idea) {

    $idea->delete();
    return redirect('/ideas');

});


// show
//Route::get('/ideas/{id}', function ($id) {
//
//    $idea = Idea::findOrFail($id);
//
//    /* if (!$idea) {
//         abort(404);
//     }*/
//
//    return view('ideas.show', [
//        'idea' => $idea
//    ]);
//
//});

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
    return redirect('/ideas');
    //    dd(request("idea"));
});

Route::get('/delete-ideas', function () {

    //    session()->forget('ideas'); // forget or delete?

    Idea::truncate();

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
