<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //        $ideas = Idea::all()->where('user_id', \Auth::user()->id);

     /*   $ideas = Idea::query()->where(
            ['user_id' => \Auth::id()]
        )->get();*/

        $ideas = \Auth::user()->ideas;

        return view('ideas.index', [ // ideas/index
            'ideas' => $ideas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ideas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request)
    {

        /*     $request->validate([
                 'description' => 'required|min:3',
             ]);*/

        //
        $idea = $request->description;

        \Auth::user()->ideas()->create([
            'description' => $idea,
            'state' => 'pending'
        ]);


      /*  Idea::create(
            [
                'description' => $idea,
                'user_id' => auth()->id(),
                'state' => 'pending'
            ]
        );*/
        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('ideas.show', [
            'idea' => $idea
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        return view('ideas.edit', [
            'idea' => $idea
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea)
    {
        /*$idea->update([
            'description' => request('description')
        ]);*/

        $idea->update([
            'description' => $request->description,
        ]);

        return redirect('/ideas/' . $idea->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {

        $idea->delete();
        return redirect('/ideas');
    }
}
