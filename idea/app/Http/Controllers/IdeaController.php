<?php

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
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
    public function store(StoreIdeaRequest $request, CreateIdea $action)
    {
//        dd($request->all());
/*        dd($request->safe()->only('title'));
        dd($request->safe()->except('steps'));*/

//        dd($request->safe()->all());


//        (new CreateIdea())->handle($request->safe()->all(), Auth::user());


        $action->handle($request->safe()->all(), Auth::user());


        return to_route('idea.index')->with('success', 'Idea has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        return view('idea.show', [
            'idea' => $idea,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdeaRequest $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        $idea->delete();
        return to_route('idea.index');
    }
}
