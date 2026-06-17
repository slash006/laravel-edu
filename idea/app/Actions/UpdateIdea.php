<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateIdea {

    public function __construct(#[CurrentUser] protected User $user)
    {

    }

    public function handle(array $attributes, Idea $idea) {


        $user = $user ?? Auth::user();
        $data = collect($attributes)
            ->only(['title', 'description', 'status', 'links'])
        ->toArray();

        if($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }


        try {
            Db::transaction(function () use ($idea, $data, $attributes) {
                $idea->update($data);
                $idea->steps()->delete();
                $idea->steps()->createMany($attributes['steps'] ?? []);

            });
            } catch (\Throwable $e) {

                dd($e->getMessage());
            }


    }
}
