<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function update(User $user, Idea $idea): bool
    {
        return $user->is($idea->user);
        //        return $user->id === $idea->user_id ? Response::allow() : Response::denyAsNotFound();

    }

    /**
     * Determine whether the user can create the model.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }
}
