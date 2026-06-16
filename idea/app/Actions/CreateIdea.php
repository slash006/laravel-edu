<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateIdea {

    public function handle(array $attributes, ?User $user = null) {


        //        dd($request->all());
        /*        dd($request->safe()->only('title'));
                dd($request->safe()->except('steps'));*/


        $user = $user ?? Auth::user();
        $data = collect($attributes)
            ->only(['title', 'description', 'status', 'links'])
        ->toArray();

        if($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }




        try {
            Db::transaction(function () use ($data, $user) {
                $idea = $user->ideas()->create($data);
                $steps = collect($attributes["steps"] ?? [])->map(function ($step) {
                    return ['description' => $step];
                });
                $idea->steps()->createMany($steps);
            });
            } catch (\Throwable $e) {

                dd($e->getMessage());
            }


    }
}
