<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SessionsController;
use App\Http\Controllers\IdeaController;
use Illuminate\Support\Facades\Route;
use App\Models\Idea;


Route::get('/', function () {

    return "Placeholder for home page";
});

Route::middleware('auth')->group(function () {

    Route::get('/ideas', [IdeaController::class, 'index']);
    Route::get('/ideas/create', [IdeaController::class, 'create']);
    Route::post('/ideas', [IdeaController::class, 'store']);
    Route::get('/ideas/{idea}', [IdeaController::class, 'show']);
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit']);
    Route::patch('/ideas/{idea}', [IdeaController::class, 'update']);
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy']);
});



Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');
Route::delete('/logout', [SessionsController::class, 'destroy'])->middleware('auth');
Route::get('/login', [SessionsController::class, 'create'])->name('login');
Route::post('/login', [SessionsController::class, 'store'])->middleware('guest');


//Route::post('/logout', function () {
//
//    Auth::logout();
//});
//


// index
//Route::get('/ideas', function () {
//
//    //    $ideas = session()->get('ideas', []);
//    //    $ideas = DB::table('ideas')->get();
//    $ideas = Idea::all();
//
//    // TODO: check Idea::query
//    //    $condition = request()->query('state', 'pending');RegisteredUserController
//    //    $ideas = Idea::where('state', $condition)->get();
//    //    dd($ideas);
//
//    return view('ideas.index', [ // ideas/index
//        'ideas' => $ideas
//    ]);
//});

// create
//Route::get('/ideas/create', function () {
//
//    return view('ideas.create');
//
//});

//// show
//Route::get('/ideas/{idea}', function (Idea $idea) {
//
//    return view('ideas.show', [
//        'idea' => $idea
//    ]);
//
//});

// edit
//Route::get('/ideas/{idea}/edit', function (Idea $idea) {
//
//    return view('ideas.edit', [
//        'idea' => $idea
//    ]);
//
//});

//// update
//Route::patch('/ideas/{idea}', function (Idea $idea) {
//
//    $idea->update([
//        'description' => request('description')
//    ]);
//
//    return redirect('/ideas/' . $idea->id);
//});

// delete
//Route::delete('/ideas/{idea}', function (Idea $idea) {
//
//    $idea->delete();
//    return redirect('/ideas');
//
//});

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

//Route::post('/ideas', function () {
//
//    $idea = request()->idea;
//
//    /*  DB::table('ideas')->insert([
//          'description' => $idea,
//          'state' => 'pending'
//      ]);*/
//
//    Idea::create(
//        [
//            'description' => $idea,
//            'state' => 'pending'
//        ]
//    );
//
//    //    session()->push('ideas', $idea);
//    return redirect('/ideas');
//    //    dd(request("idea"));
//});

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
