<?php

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\Actions\UpdateIdea;
use App\Http\Requests\IdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $ideas = Idea::all();
        $ideas = Auth::user()->ideas()
            ->when(request('status'), function ($query, $search) {
                return $query->where('status', $search);
            })
//            ->where('status', request('status', 'completed'))
                ->orderByDesc('created_at')
            ->get();




        return view('idea.index',
            [
                'ideas' => $ideas,
                'statusCounts' => Idea::statusCount(Auth::user()),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request, CreateIdea $action)
    {
//        dd($request->all());
/*        dd($request->safe()->only('title'));
          dd($request->safe()->except('steps'));*/
//        dd($request->safe()->all());
//        (new CreateIdea())->handle($request->safe()->all(), Auth::user());

        $action->handle($request->safe()->all());
        return to_route('idea.index')->with('success', 'Idea has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        Gate::authorize('workWith', $idea);
        return view('idea.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        Gate::authorize('workWith', $idea);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea, UpdateIdea $action)
    {

        $action->handle($request->safe()->all(), $idea);
        return back()->with('success', 'Idea has been updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        Gate::authorize('workWith', $idea);
        $idea->delete();
        return to_route('idea.index');
    }
}
